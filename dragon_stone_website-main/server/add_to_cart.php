<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
include('/server/configure.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../shop.php');
    exit;
}
// Accept either product_id or product_name + product_price from older forms
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$qty = isset($_POST['quantity']) ? max(1, intval($_POST['quantity'])) : 1;

if ($product_id > 0) {
    $stmt = mysqli_prepare($conn, "SELECT id, name, price, image, stock FROM products WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $product_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($res);
    mysqli_stmt_close($stmt);
    if (!$product) {
        $_SESSION['error'] = "Product not found.";
        header('Location: ../shop.php');
        exit;
    }
} else {
    // fallback for forms that post name/price/image directly
    if (empty($_POST['product_name']) || empty($_POST['product_price'])) {
        $_SESSION['error'] = "Invalid product data.";
        header('Location: ../shop.php');
        exit;
    }
    $product = [
        'id' => 0,
        'name' => $_POST['product_name'],
        'price' => floatval($_POST['product_price']),
        'image' => $_POST['product_image'] ?? '',
        'stock' => 9999
    ];
}

// init cart
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

$key = $product['id'] > 0 ? 'id_'.$product['id'] : 'name_'.md5($product['name']);

if (isset($_SESSION['cart'][$key])) {
    $_SESSION['cart'][$key]['quantity'] += $qty;
} else {
    $_SESSION['cart'][$key] = [
        'product_id' => $product['id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'image' => $product['image'],
        'quantity' => $qty
    ];
}

header('Location: ../cart.php');
exit;
?>



<?php
include('server/configure.php');
session_start();

$result = mysqli_query($conn, "SELECT * FROM products");

echo '<div class="row">';
while ($row = mysqli_fetch_assoc($result)) {
    echo "
    <div class='one col-lg-4 col-sm-12 p-0'>
        <img class='img-fluid' src='{$row['image']}' alt='{$row['name']}' />
        <div class='details text-center'>
            <h2>{$row['name']}</h2>
            <p>R{$row['price']}</p>
            <form method='POST' action='add_to_cart.php'>
                <input type='hidden' name='product_id' value='{$row['id']}'>
                <input type='number' name='quantity' value='1' min='1'>
                <button type='submit' class='btn btn-dark text-uppercase'>ADD TO CART</button>
            </form>
        </div>
    </div>
    ";
}
echo '</div>';
?>

