<?php
// server/payments/paypal_capture_order.php
require_once __DIR__ . '/../configure.php';

$paypalOrderId = $_GET['token'] ?? null;
if (!$paypalOrderId) {
    http_response_code(400);
    echo "Missing order token.";
    exit;
}

$paypalBase = ($paypal_env === 'live') ? "https://api-m.paypal.com" : "https://api-m.sandbox.paypal.com";

// get access token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paypalBase . "/v1/oauth2/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $paypal_client_id . ":" . $paypal_client_secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Accept: application/json"]);
$res = curl_exec($ch);
$tokenData = json_decode($res, true);
$accessToken = $tokenData['access_token'] ?? null;
curl_close($ch);
if (!$accessToken) {
    http_response_code(500);
    echo "Could not obtain PayPal access token.";
    exit;
}

// capture the order
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paypalBase . "/v2/checkout/orders/" . urlencode($paypalOrderId) . "/capture");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $accessToken"
]);
$res = curl_exec($ch);
$captureRes = json_decode($res, true);
curl_close($ch);

if (!isset($captureRes['status']) || !in_array($captureRes['status'], ['COMPLETED','APPROVED'])) {
    echo "<h2>Payment not completed</h2><pre>" . htmlentities($res) . "</pre>";
    exit;
}

// Update DB order status
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $pdo->prepare("UPDATE orders SET status = ?, provider_capture_response = ?, updated_at = NOW() WHERE provider_order_id = ?");
    $stmt->execute(['paid', json_encode($captureRes), $paypalOrderId]);

    header("Location: {$base_url}/checkout.php?success=paypal&order=" . urlencode($paypalOrderId));
    exit;
} catch (Exception $e) {
    error_log("DB update error: " . $e->getMessage());
    echo "Payment captured, but DB update failed.";
}
