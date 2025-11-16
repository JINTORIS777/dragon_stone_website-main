<?php
// server/payments/stripe_webhook.php
require_once __DIR__ . '/../configure.php';
require_once __DIR__ . '/../../vendor/autoload.php';

\Stripe\Stripe::setApiKey($stripe_secret_key);

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';
$endpoint_secret = $stripe_webhook_secret;

try {
    $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
} catch(Exception $e) {
    http_response_code(400);
    exit();
}

if ($event->type === 'checkout.session.completed') {
    $session = $event->data->object;
    $session_id = $session->id;
    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $stmt = $pdo->prepare("UPDATE orders SET status = ?, provider_capture_response = ?, updated_at = NOW() WHERE provider_order_id = ?");
        $stmt->execute(['paid', json_encode($session), $session_id]);
    } catch (Exception $e) {
        error_log("Stripe webhook DB update error: " . $e->getMessage());
    }
}

http_response_code(200);
echo json_encode(['received' => true]);
