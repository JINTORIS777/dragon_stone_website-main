<?php
// server/payments/stripe_create_session.php
require_once __DIR__ . '/../configure.php';
require_once __DIR__ . '/../../vendor/autoload.php'; // if using composer, vendor must be present

\Stripe\Stripe::setApiKey($stripe_secret_key);

$input = json_decode(file_get_contents('php://input'), true);
$amount = isset($input['amount']) ? (int) round(floatval($input['amount']) * 100) : 0; // in cents
if ($amount <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid amount']);
    exit;
}

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => $currency_code,
                'product_data' => [
                    'name' => 'Dragon Stone Purchase',
                ],
                'unit_amount' => $amount,
            ],
            'quantity' => 1
        ]],
        'mode' => 'payment',
        'success_url' => $base_url . '/checkout.php?success=stripe&session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => $base_url . '/checkout.php?cancelled=1'
    ]);

    // Insert pending order row (store session id)
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $pdo->prepare("INSERT INTO orders (provider, provider_order_id, amount, currency, status, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->execute(['stripe', $session->id, $amount / 100.0, $currency_code, 'pending']);
    $localOrderId = $pdo->lastInsertId();

    echo json_encode(['id' => $session->id, 'url' => $session->url, 'local_order_id' => $localOrderId]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
