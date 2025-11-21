<?php
require_once __DIR__.'/server/auth.php';
session_start();
session_unset(); session_destroy();
header('Location: index.php'); exit;
?>