<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['cart'])) {
    echo json_encode(['success'=>false, 'message' => 'Cart not initialized.']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);
if (!$data || !isset($data['product_id']) || !isset($data['action'])) {
    echo json_encode(['success'=>false, 'message' => 'Missing parameters.']);
    exit;
}
$id = $data['product_id'];
$action = $data['action'];

if (!isset($_SESSION['cart'][$id])) {
    echo json_encode(['success'=>false, 'message' => 'Item not found.']);
    exit;
}

if ($action === 'increase') {
    $_SESSION['cart'][$id]['qty'] += 1;
    echo json_encode(['success'=>true, 'message'=>'Quantity increased.', 'new_qty' => $_SESSION['cart'][$id]['qty']]);
    exit;
} elseif ($action === 'decrease') {
    if ($_SESSION['cart'][$id]['qty'] > 1) {
        $_SESSION['cart'][$id]['qty'] -= 1;
        echo json_encode(['success'=>true, 'message'=>'Quantity decreased.', 'new_qty' => $_SESSION['cart'][$id]['qty']]);
    } else {
        unset($_SESSION['cart'][$id]);
        echo json_encode(['success'=>true, 'message'=>'Item removed.', 'removed' => true]);
    }
    exit;
} elseif ($action === 'remove') {
    unset($_SESSION['cart'][$id]);
    echo json_encode(['success'=>true, 'message'=>'Item removed.', 'removed' => true]);
    exit;
}

echo json_encode(['success'=>false, 'message'=>'Unknown action.']);
exit;
?>

