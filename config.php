<?php
// Update these settings for your XAMPP environment
define('DB_HOST', '127.0.0.1');
define('DB_PORT', 3306);
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'dragon_stone');

// PayPal settings
define('PAYPAL_SANDBOX', true); // true = sandbox, false = live
define('PAYPAL_BUSINESS', 'your-paypal-email@example.com');
// Update these to match the local dev server (port 8000 used by php -S)
define('PAYPAL_RETURN_URL', 'http://localhost:8000/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost:8000/cancel.php');
// Optional: add a placeholder for PayPal JS client ID if you want to implement the JS Checkout buttons
define('PAYPAL_CLIENT_ID', 'YOUR_PAYPAL_SANDBOX_CLIENT_ID');

function db_connect(){
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        if($conn->connect_error) {
            error_log('DB Connect error: '.$conn->connect_error);
            return false;
        }
        return $conn;
    } catch (Exception $e) {
        error_log('Database connection failed: ' . $e->getMessage());
        return false;
    }
}
?>