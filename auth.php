<?php
require_once __DIR__ . '/config.php';
session_start();
function is_logged_in(){ return isset($_SESSION['user_id']); }
function require_login(){ if(!is_logged_in()){ header('Location: login.php'); exit; } }
function get_user($id){
    $conn = db_connect();
    $stmt = $conn->prepare('SELECT id, user_name AS name, email FROM users WHERE id = ? LIMIT 1');
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $user;
}
?>