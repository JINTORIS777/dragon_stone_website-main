<?php
require_once __DIR__.'/server/auth.php';
require_login();
$user = get_user($_SESSION['user_id']);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Account</title></head><body>
<h2>Account</h2>
<p>Logged in as: <strong><?=htmlspecialchars($user['email'] ?? $_SESSION['email'])?></strong></p>
<p>Name: <?=htmlspecialchars($user['name'] ?? '')?></p>
<p><a href="logout.php">Logout</a></p>
<p><a href="checkout.php">Go to Checkout</a></p>
</body></html>
