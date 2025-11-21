<?php
require_once __DIR__.'/server/auth.php';
session_start();
$amount = 10.00;
$currency = 'USD';
?>
<!doctype html><html><head><meta charset="utf-8"><title>Checkout</title></head><body>
<h2>Checkout</h2>
<p>Amount: <?=number_format($amount,2)?> <?=htmlspecialchars($currency)?></p>
<form method="post" action="pay.php">
    <input type="hidden" name="amount" value="<?=htmlspecialchars($amount)?>">
    <input type="hidden" name="currency" value="<?=htmlspecialchars($currency)?>">
    <button type="submit" name="confirm">Confirm Order — Pay with PayPal</button>
</form>
</body></html>
v