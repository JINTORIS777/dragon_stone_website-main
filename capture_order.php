<?php
require_once __DIR__ . '/config.php';
header('Content-Type: application/json');
session_start();

$orderId = $_POST['orderID'] ?? null;
$plan_id = $_POST['plan_id'] ?? null;
$plan_name = $_POST['plan_name'] ?? null;

if (!$orderId) {
    http_response_code(400);
    echo json_encode(['error' => 'missing orderID']);
    exit;
}

// Get access token
$tokenUrl = PAYPAL_SANDBOX ? 'https://api.sandbox.paypal.com/v1/oauth2/token' : 'https://api.paypal.com/v1/oauth2/token';
$ch = curl_init($tokenUrl);
curl_setopt($ch, CURLOPT_USERPWD, PAYPAL_CLIENT_ID . ':' . PAYPAL_CLIENT_SECRET);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tokenRes = json_decode(curl_exec($ch), true);
$err = curl_error($ch);
curl_close($ch);

$accessToken = $tokenRes['access_token'] ?? null;
if (!$accessToken) {
    http_response_code(500);
    echo json_encode(['error' => 'no access token', 'details' => $tokenRes, 'curl_error' => $err]);
    exit;
}

$captureUrl = (PAYPAL_SANDBOX ? 'https://api.sandbox.paypal.com' : 'https://api.paypal.com') . "/v2/checkout/orders/{$orderId}/capture";
$ch = curl_init($captureUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $accessToken
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = json_decode(curl_exec($ch), true);
$curlErr = curl_error($ch);
curl_close($ch);

// If capture succeeded, record payment and subscription (if user logged in)
if ($res && isset($res['status']) && in_array($res['status'], ['COMPLETED','COMPLETED_WITH_ERRORS','APPROVED','PAYER_ACTION_REQUIRED','VOIDED']) ) {
    // Attempt to extract amount and currency
    $amount = null; $currency = null;
    if (!empty($res['purchase_units'][0]['payments']['captures'][0]['amount'])) {
        $amt = $res['purchase_units'][0]['payments']['captures'][0]['amount'];
        $amount = $amt['value'] ?? null;
        $currency = $amt['currency_code'] ?? null;
    }

    // Record to DB if possible
    if (!empty($_SESSION['user_id'])) {
        $conn = null;
        try {
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
            if ($conn->connect_error) throw new Exception('DB connect error: '.$conn->connect_error);

            $user_id = (int)$_SESSION['user_id'];
            $provider = 'paypal';
            $provider_order = $orderId;
            $status = $res['status'];
            $raw = $conn->real_escape_string(json_encode($res));
            $amount_sql = $amount !== null ? (float)$amount : 0.00;
            $currency_sql = $currency ?: 'USD';

            $ins = "INSERT INTO payments (user_id, provider, provider_order_id, amount, currency, status, raw_response) VALUES ({$user_id}, '{$provider}', '{$provider_order}', {$amount_sql}, '{$currency_sql}', '{$status}', '{$raw}')";
            $conn->query($ins);

            // If plan info provided, create subscription row (simple monthly duration example)
            if ($plan_name || $plan_id) {
                $plan_display = $conn->real_escape_string($plan_name ?: $plan_id);
                $started = date('Y-m-d H:i:s');
                // Default to 30 days for monthly plans
                $expires = date('Y-m-d H:i:s', strtotime('+30 days'));
                $insSub = "INSERT INTO subscriptions (user_id, plan_name, plan_id, status, started_at, expires_at) VALUES ({$user_id}, '{$plan_display}', '{$plan_id}', 'active', '{$started}', '{$expires}')";
                $conn->query($insSub);
            }

        } catch (Exception $e) {
            // Log DB error to response for debugging (non-sensitive)
            $res['__db_error'] = $e->getMessage();
        } finally {
            if ($conn) $conn->close();
        }
    }

    echo json_encode($res);
    exit;
}

// Fallthrough: return capture response or error
if ($res) echo json_encode($res); else { http_response_code(500); echo json_encode(['error'=>'capture failed','curl_error'=>$curlErr]); }

?>
