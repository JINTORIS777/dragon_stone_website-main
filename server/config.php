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
define('PAYPAL_RETURN_URL', 'http://localhost/dragon_stone_project_root/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/dragon_stone_project_root/cancel.php');

function db_connect(){
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    if($conn->connect_error) die('DB Connect error: '.$conn->connect_error);
    return $conn;
}
?>