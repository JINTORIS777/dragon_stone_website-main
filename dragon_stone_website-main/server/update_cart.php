<?php
session_start();

if (!isset($_SESSION['cart'])) {
    echo json_encode(['message' => 'Cart not initialized.']);
    exit;
}

if (isset($_POST['key']) && isset($_POST['quantity'])) {
    $key = intval($_POST['key']);
    $quantity = intval($_POST['quantity']);

    if ($quantity < 1) {
        echo json_encode(['message' => 'Invalid quantity.']);
        exit;
    }

    if (array_key_exists($key, $_SESSION['cart'])) {
        $_SESSION['cart'][$key]['quantity'] = $quantity;
        echo json_encode(['message' => 'Quantity updated.']);
    } else {
        echo json_encode(['message' => 'Item not found.']);
    }
} else {
    echo json_encode(['message' => 'Missing parameters.']);
}
?>

