<?php
session_start();
header('Content-Type: application/json');

// Accept JSON or form POST
$input = file_get_contents('php://input');
$data = json_decode($input, true);
if ($data) {
    $product_id = isset($data['product_id']) ? $data['product_id'] : '';
    $name = isset($data['name']) ? $data['name'] : '';
    $price = isset($data['price']) ? floatval($data['price']) : 0;
    $image = isset($data['image']) ? $data['image'] : '';
    $qty = isset($data['qty']) ? intval($data['qty']) : 1;
} else {
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
    $image = isset($_POST['image']) ? $_POST['image'] : '';
    $qty = isset($_POST['qty']) ? intval($_POST['qty']) : 1;
}

if (!$product_id && !$name) {
    echo json_encode(['success'=>false, 'message'=>'Missing product info.']);
    exit;
}
if ($qty < 1) $qty = 1;

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
$key = $product_id ? $product_id : md5($name);
if (isset($_SESSION['cart'][$key])) {
    $_SESSION['cart'][$key]['qty'] += $qty;
} else {
    $_SESSION['cart'][$key] = [
        'product_id' => $product_id,
        'name' => $name,
        'price' => $price,
        'image' => $image,
        'qty' => $qty
    ];
}
echo json_encode(['success'=>true, 'message'=>'Added to cart.']);
exit;

