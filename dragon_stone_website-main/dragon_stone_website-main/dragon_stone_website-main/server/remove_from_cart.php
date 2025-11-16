<?php
session_start();

if (!isset($_SESSION['cart'])) {
    echo json_encode(['message' => 'Cart is empty or not initialized.']);
    exit;
}

if (isset($_POST['key'])) {
    $key = intval($_POST['key']);

    if (array_key_exists($key, $_SESSION['cart'])) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index
        echo json_encode(['message' => 'Item removed successfully.']);
    } else {
        echo json_encode(['message' => 'Invalid item index.']);
    }
} else {
    echo json_encode(['message' => 'No item index provided.']);
}
?>
