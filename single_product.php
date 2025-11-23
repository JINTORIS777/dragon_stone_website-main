<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);

// Get product ID from URL
$productId = $_GET['product'] ?? '';
if (!$productId) {
    die('No product selected.');
}

// Product map (replace with DB later)
$products = [
    'bapestas'         => ['name' => 'BAPESTAS',          'price' => 5000, 'img' => 'assets/images/BAPESTAS.JPG'],
    'goth-guitar'      => ['name' => 'GOTH GUITAR',       'price' => 6000, 'img' => 'assets/images/GOTH GUITER.JPG'],
    'designer-jacket'  => ['name' => 'DESIGNER JACKETS',  'price' => 6000, 'img' => 'assets/images/DESIGNER JACKET.JPG'],
    'green-jacket'     => ['name' => 'GREEN JACKETS',     'price' => 6000, 'img' => 'assets/images/GREEN JACKET.JPEG'],
    'neon-bapestas'    => ['name' => 'NEON BAPESTAS',     'price' => 8000, 'img' => 'assets/images/NEON BAPESTAS.JPG'],
    'polaroid-camera'  => ['name' => 'POLAROID CAMERAS',  'price' => 9000, 'img' => 'assets/images/POLA-ROID.jpeg'],
    'green-camera'     => ['name' => 'GREEN CAMERA',      'price' => 9000, 'img' => 'assets/images/GREEN--CAMERA.JPEG'],
    'toys'             => ['name' => 'TOYS',              'price' => 2000, 'img' => 'assets/images/TOYS.JPEG'],
    'ice-frost-watch'  => ['name' => 'ICE FROST WATCHES', 'price' => 10000, 'img' => 'assets/images/PATTEK ICE.JPEG'],
    'frost-watch'      => ['name' => 'FROST WATCHES',     'price' => 20000, 'img' => 'assets/images/FROST.JPG'],
    'luxury-watch'     => ['name' => 'LUXURY WATCHES',    'price' => 80000, 'img' => 'assets/images/ROLLIEEE.JPEG'],
    'pattek-philippe'  => ['name' => 'PATTEK PHILIPP WATCHES', 'price' => 8000, 'img' => 'assets/images/PATTEK PHILIP.JPG'],
];

$product = $products[$productId] ?? null;
if (!$product) {
    die('Product not found.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> – DRAGON STONE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" />
    <style>
        /* [ALL YOUR ORIGINAL SINGLE PRODUCT CSS] */
        body { background-image: url('assets/images/GREEN.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; margin: 0; padding: 0; font-family: Arial, sans-serif; min-height: 100vh; }
        .navbar-custom { background-color: #1b4d3e; }
        .navbar-custom .navbar-brand, .navbar-custom .nav-link { color: #ffffff; font-weight: 500; }
        .navbar-custom .nav-link:hover { color: #a5c9a1; }
        .cart-counter { position: absolute; top: -10px; right: -10px; background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px; }
        .main-product-img { max-width: 300px; height: auto; display: block; margin: 0 auto; }
        .small-product-img { max-width: 60px; height: auto; cursor: pointer; transition: transform 0.3s ease; }
        .small-product-img:hover { transform: scale(1.1); }
        .buy-btn { background-color: #a5c9a1; color: #1b4d3e; border: none; padding: 10px 20px; border-radius: 5px; font-weight: 500; margin-top: 10px; }
        .buy-btn:hover { background-color: #8ab87d; }
        .product-details { color: #ffffff; }
        .product-details h6 { font-size: 1.5rem; font-weight: bold; }
        .product-details h2 { font-size: 2rem; color: #a5c9a1; }
        .product-details h4 { font-size: 1.25rem; font-weight: bold; }
        .product-details span { font-size: 1rem; color: #cccccc; }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.html">DRAGON STONE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="index.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">ABOUT</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">CONTACT</a></li>
                    <li class="nav-item"><a class="nav-link" href="shop.php">SHOP</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            <i class="fa-solid fa-cart-shopping"></i>CART
                            <span class="cart-counter">0</span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="fa-regular fa-user"></i> LOGIN</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- SINGLE PRODUCT -->
    <section class="single-product my-5 pt-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <img id="mainIMG" class="img-fluid main-product-img" src="<?= htmlspecialchars($product['img']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
                    <div class="small-img-group mt-3">
                        <div class="d-flex justify-content-between">
                            <div class="small-img-col"><img src="assets/images/GUCCI.JPG" class="small-product-img" /></div>
                            <div class="small-img-col"><img src="assets/images/GOTH GUITER.JPG" class="small-product-img" /></div>
                            <div class="small-img-col"><img src="assets/images/TOYS.JPEG" class="small-product-img" /></div>
                            <div class="small-img-col"><img src="assets/images/POLA-ROID.jpeg" class="small-product-img" /></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 product-details">
                    <h6><?= htmlspecialchars($product['name']) ?></h6>
                    <h2>R<?= number_format($product['price']) ?></h2>
                    <input type="number" value="1" min="1" />
                    <button class="buy-btn" onclick="addToCart('<?= $productId ?>')">ADD TO CART</button>
                    <h4 class="mt-5 mb-5">PRODUCT DETAILS</h4>
                    <span>THE DETAILS OF THIS PRODUCT WILL BE DISPLAYED SHORTLY</span>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <h5 class="footer-title">DRAGON STONE</h5>
                    <p class="footer-description">Your premier destination for premium sports shoes, luxury watches, and stylish outerwear.</p>
                    <p class="footer-copyright">&copy; 2025 DRAGON STONE. ALL RIGHTS RESERVED.</p>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <h5 class="footer-title">CUSTOMER SERVICE</h5>
                    <div class="footer-links">
                        <a href="#"><i class="fas fa-truck"></i>SHIPPING POLICY</a>
                        <a href="#"><i class="fas fa-exchange-alt"></i>RETURNS</a>
                        <a href="#"><i class="fas fa-question-circle"></i>FAQs</a>
                        <a href="#"><i class="fas fa-envelope"></i>CONTACT US</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                    <h5 class="footer-title">FOLLOW US</h5>
                    <p class="footer-description">STAY UPDATED WITH OUR LATEST COLLECTIONS AND PROMOTIONS</p>
                    <div class="social-icons">
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="newsletter-form text-center">
                        <h6>SUBSCRIBE TO OUR NEWSLETTER</h6>
                        <form>
                            <div class="input-group">
                                <input type="email" class="form-control newsletter-input" placeholder="Enter your email address" required>
                                <button class="btn newsletter-btn" type="submit">SUBSCRIBE</button>
                            </div>
                            <small class="newsletter-text">GET THE LATEST UPDATES AND EXCLUSIVE OFFERS</small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const product = <?php echo json_encode($product); ?>;
        const productId = '<?= $productId ?>';

        function updateCartCounter() {
            const counter = document.querySelector('.cart-counter');
            const total = cart.reduce((s, i) => s + i.quantity, 0);
            counter.textContent = total;
        }

        function addToCart(id) {
            const existing = cart.find(i => i.id === id);
            if (existing) existing.quantity += 1;
            else cart.push({ id, name: product.name, price: product.price, image: product.img, quantity: 1 });
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCounter();
            alert(`${product.name} added to cart!`);
        }

        document.getElementById('mainIMG').addEventListener('click', function() {
            // Optional: enlarge on click
        });

        document.querySelectorAll('.small-product-img').forEach(img => {
            img.addEventListener('click', function() {
                document.getElementById('mainIMG').src = this.src;
            });
        });

        document.addEventListener('DOMContentLoaded', updateCartCounter);
    </script>
</body>
</html>