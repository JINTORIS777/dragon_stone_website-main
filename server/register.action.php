<?php
// server/register_action.php
session_start();
require_once __DIR__ . '/configure.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../register.php');
    exit;
}

$full = trim($_POST['full_name'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$pw = $_POST['password'] ?? '';

if (!$email || strlen($pw) < 6) {
    $_SESSION['error'] = "Provide a valid email and password (min 6 chars).";
    header('Location: ../register.php');
    exit;
}

// simple hash
$hash = password_hash($pw, PASSWORD_DEFAULT);

// check existing
$stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
if (mysqli_fetch_assoc($res)) {
    $_SESSION['error'] = "Email already registered.";
    header('Location: ../register.php');
    exit;
}
mysqli_stmt_close($stmt);

// insert
$stmt = mysqli_prepare($conn, "INSERT INTO users (email, password_hash, full_name) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'sss', $email, $hash, $full);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$_SESSION['success'] = "Account created. Please log in.";
header('Location: ../login.php');
exit;
?>