<?php
// Database config - replace with your values or set environment variables on host
$db_host = getenv('DB_HOST') ?: "localhost";
$db_user = getenv('DB_USER') ?: "root";
$db_pass = getenv('DB_PASS') ?: "";
$db_name = getenv('DB_NAME') ?: "dragon_stone";

// PayPal config (placeholders)
$paypal_env = getenv('PAYPAL_ENV') ?: 'sandbox'; // 'sandbox' or 'live'
$paypal_client_id = getenv('PAYPAL_CLIENT_ID') ?: 'YOUR_PAYPAL_CLIENT_ID';
$paypal_client_secret = getenv('PAYPAL_CLIENT_SECRET') ?: 'YOUR_PAYPAL_SECRET';

// Stripe config (placeholders)
$stripe_secret_key = getenv('STRIPE_SECRET_KEY') ?: 'sk_test_YOUR_KEY';
$stripe_publishable_key = getenv('STRIPE_PUBLISHABLE_KEY') ?: 'pk_test_YOUR_KEY';
$stripe_webhook_secret = getenv('STRIPE_WEBHOOK_SECRET') ?: 'whsec_YOUR_KEY';

// Base URL for return/cancel links - change to your site URL when deploying
$base_url = getenv('BASE_URL') ?: 'https://yourdomain.com';

// Currency - changed to ZAR
$currency_code = 'ZAR';
?>