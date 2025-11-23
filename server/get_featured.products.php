<?php

session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
//include('../server/connection.php');

$sconn->prepare("SELECT * FROM products LIMIT 4");

$stmt->execute();

$featured_products = $stmt->get_results();

?>
