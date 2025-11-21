<?php
// server/login_action.php
session_start();
require_once __DIR__ . '/configure.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php');
    exit;
}

$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$pw = $_POST['password'] ?? '';

if (!$email || !$pw) {
    $_SESSION['error'] = "Enter email and password.";
    header('Location: ../login.php');
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT id, password_hash, full_name FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$user || !password_verify($pw, $user['password_hash'])) {
    $_SESSION['error'] = "Invalid credentials.";
    header('Location: ../login.php');
    exit;
}

$_SESSION['user'] = ['id' => $user['id'], 'email' => $email, 'full_name' => $user['full_name']];
header('Location: ../shop.php');
exit;
?>