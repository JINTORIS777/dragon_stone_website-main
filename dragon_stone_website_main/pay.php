<?php
require_once __DIR__.'/server/config.php';
require_once __DIR__.'/server/auth.php';
session_start();
if($_SERVER['REQUEST_METHOD']!=='POST'){ header('Location: checkout.php'); exit; }
$amount = number_format((float)($_POST['amount'] ?? '0'),2,'.','');
$currency = $_POST['currency'] ?? 'USD';
$business = PAYPAL_BUSINESS;
$paypal_url = PAYPAL_SANDBOX ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
?>
<!doctype html><html><head><meta charset="utf-8"><title>Redirecting to PayPal</title></head><body>
<p>Redirecting to PayPal — if not redirected, click Pay Now.</p>
<form id="paypalForm" action="<?=htmlspecialchars($paypal_url)?>" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="<?=htmlspecialchars($business)?>">
    <input type="hidden" name="item_name" value="Order from DragonStone">
    <input type="hidden" name="amount" value="<?=htmlspecialchars($amount)?>">
    <input type="hidden" name="currency_code" value="<?=htmlspecialchars($currency)?>">
    <input type="hidden" name="return" value="<?=htmlspecialchars(PAYPAL_RETURN_URL)?>">
    <input type="hidden" name="cancel_return" value="<?=htmlspecialchars(PAYPAL_CANCEL_URL)?>">
    <button type="submit">Pay Now</button>
</form>
<script>document.getElementById('paypalForm').submit();</script>
</body></html>
