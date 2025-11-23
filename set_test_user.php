<?php
// Quick helper for dev preview: sets a test user id in session then redirects back.
session_start();
// Set a non-privileged test user id (ensure this user id exists in your DB if you plan to test DB writes)
$_SESSION['user_id'] = 1;
// Redirect back to subscription page
$back = $_GET['back'] ?? '/subscription.php';
header('Location: ' . $back);
exit;
?>