<?php
require_once __DIR__ . '/config.php';
header('Content-Type: application/json');

$body = json_decode(file_get_contents('php://input'), true) ?? [];
$amount = number_format((float)($body['amount'] ?? 0), 2, '.', '');
$currency = $body['currency'] ?? 'USD';

if (!$amount || $amount <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid amount']);
    exit;
}

// Obtain access token
$tokenUrl = PAYPAL_SANDBOX ? 'https://api.sandbox.paypal.com/v1/oauth2/token' : 'https://api.paypal.com/v1/oauth2/token';
$ch = curl_init($tokenUrl);
curl_setopt($ch, CURLOPT_USERPWD, PAYPAL_CLIENT_ID . ':' . PAYPAL_CLIENT_SECRET);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
$tokenRes = json_decode(curl_exec($ch), true);
$err = curl_error($ch);
curl_close($ch);

if (empty($tokenRes['access_token'])) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to get access token', 'details' => $tokenRes, 'curl_error' => $err]);
    exit;
}
$accessToken = $tokenRes['access_token'];

// Create order
$createUrl = PAYPAL_SANDBOX ? 'https://api.sandbox.paypal.com/v2/checkout/orders' : 'https://api.paypal.com/v2/checkout/orders';
$orderData = [
    'intent' => 'CAPTURE',
    'purchase_units' => [[
        'amount' => ['currency_code' => $currency, 'value' => $amount]
    ]],
    'application_context' => [
        'return_url' => PAYPAL_RETURN_URL,
        'cancel_url' => PAYPAL_CANCEL_URL
    ]
];

$ch = curl_init($createUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: ' . 'Bearer ' . $accessToken
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = json_decode(curl_exec($ch), true);
$curlErr = curl_error($ch);
curl_close($ch);

if (isset($res['id'])) {
    echo json_encode(['id' => $res['id'], 'raw' => $res]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed creating order', 'details' => $res, 'curl_error' => $curlErr]);
}

?>
