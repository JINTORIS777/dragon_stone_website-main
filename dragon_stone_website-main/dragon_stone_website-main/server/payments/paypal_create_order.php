<?php
// server/payments/paypal_create_order.php
require_once __DIR__ . '/../configure.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$amount = isset($input['amount']) ? number_format((float)$input['amount'], 2, '.', '') : null;
if (!$amount || $amount <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid amount']);
    exit;
}

$paypalBase = ($paypal_env === 'live') ? "https://api-m.paypal.com" : "https://api-m.sandbox.paypal.com";

// Get access token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paypalBase . "/v1/oauth2/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $paypal_client_id . ":" . $paypal_client_secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: application/json",
    "Accept-Language: en_US"
]);
$res = curl_exec($ch);
if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['error' => curl_error($ch)]);
    exit;
}
$tokenData = json_decode($res, true);
$accessToken = $tokenData['access_token'] ?? null;
curl_close($ch);
if (!$accessToken) {
    http_response_code(500);
    echo json_encode(['error' => 'Could not obtain PayPal access token']);
    exit;
}

// Create order
$createOrder = [
    'intent' => 'CAPTURE',
    'purchase_units' => [[
        'amount' => [
            'currency_code' => $currency_code,
            'value' => $amount
        ]
    ]],
    'application_context' => [
        'return_url' => $base_url . '/server/payments/paypal_capture_order.php',
        'cancel_url' => $base_url . '/checkout.php?cancelled=1'
    ]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paypalBase . "/v2/checkout/orders");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($createOrder));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $accessToken"
]);
$res = curl_exec($ch);
if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['error' => curl_error($ch)]);
    exit;
}
$order = json_decode($res, true);
curl_close($ch);

if (!isset($order['id'])) {
    http_response_code(500);
    echo json_encode(['error' => 'Could not create PayPal order', 'details' => $order]);
    exit;
}

// Save order to DB (best-effort)
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $pdo->prepare("INSERT INTO orders (provider, provider_order_id, amount, currency, status, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->execute(['paypal', $order['id'], $amount, $createOrder['purchase_units'][0]['amount']['currency_code'], 'pending']);
    $localOrderId = $pdo->lastInsertId();
} catch (Exception $e) {
    error_log("DB error: " . $e->getMessage());
    $localOrderId = null;
}

$approveLink = null;
foreach ($order['links'] as $link) {
    if ($link['rel'] === 'approve') { $approveLink = $link['href']; break; }
}

echo json_encode(['paypal_order_id' => $order['id'], 'approve_link' => $approveLink, 'local_order_id' => $localOrderId]);
