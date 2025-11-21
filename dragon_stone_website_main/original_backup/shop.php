<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
//include('../server/configure.php');
// Now you can safely use $conn
$sql = "SELECT * FROM products";
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Shop premium products at Dragon Stone with the best prices in the market.">
        <meta property="og:title" content="Dragon Stone - Premium Products">
        
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shop premium products at Dragon Stone with the best prices in the market.">
    <meta property="og:title" content="Dragon Stone - Premium Products">
    <meta property="og:description" content="Shop premium sports shoes, luxury watches, and stylish outerwear at Dragon Stone.">
    <meta property="og:image" content="assets/images/GREEN.jpg">
    <meta property="og:url" content="https://www.dragonstone.com">
    <meta name="twitter:card" content="summary_large_image">
    <title>DRAGON STONE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" />
    <style>
        /* [ALL YOUR ORIGINAL CSS UNCHANGED] */
        body { background-image: url('assets/images/GREEN.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; margin: 0; padding: 0; font-family: Arial, sans-serif; min-height: 100vh; }
        .navbar-custom { background-color: #1b4d3e; }
        .navbar-custom .navbar-brand, .navbar-custom .nav-link { color: #ffffff; font-weight: 500; transition: color 0.3s ease; }
        .navbar-custom .nav-link:hover { color: #a5c9a1; }
        .navbar-custom .fa-cart-shopping, .navbar-custom .fa-user { color: #ffffff; }
        .star .fas.fa-star { color: yellow; }
        .cart-counter { position: absolute; top: -10px; right: -10px; background: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px; }
        .one { position: relative; overflow: hidden; padding: 0; }
        .one img { transition: transform 0.3s ease; width: 100%; display: block; }
        .one:hover img { transform: scale(1.05); }
        .details { position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); background: rgba(0, 0, 0, 0.7); color: white; padding: 10px 20px; border-radius: 5px; width: 80%; }
        .footer-section { background-color: #1b4d3e; color: white; padding: 40px 0 20px; }
        .footer-title { font-weight: bold; margin-bottom: 15px; }
        .footer-description { font-size: 14px; margin-bottom: 10px; }
        .footer-links a { display: block; color: #a5c9a1; text-decoration: none; margin-bottom: 8px; transition: color 0.3s ease; }
        .footer-links a:hover { color: white; }
        .social-icons a { color: white; font-size: 20px; margin-right: 15px; transition: color 0.3s ease; }
        .social-icons a:hover { color: #a5c9a1; }
        .footer-divider { border-color: #a5c9a1; margin: 30px 0; }
        .newsletter-btn { background-color: #a5c9a1; color: #1b4d3e; border: none; border-radius: 0 5px 5px 0; padding: 10px 20px; }
        #featured h3, .search-section h2 { color: white !important; }
        #featured p { color: white !important; }
        .search-section { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; min-height: 50vh; background: rgba(0, 0, 0, 0.6); border-radius: 10px; padding: 30px; margin: 50px auto; max-width: 600px; }
        .search-btn { background-color: #a5c9a1; color: #1b4d3e; border: none; padding: 12px 24px; border-radius: 0 5px 5px 0; cursor: pointer; }
        .search-btn:hover { background-color: #8ba888; }
        .filter-btn, .reset-btn { background-color: #a5c9a1; color: #1b4d3e; border: none; padding: 12px 24px; border-radius: 5px; cursor: pointer; }
        .filter-btn:hover, .reset-btn:hover { background-color: #8ba888; }
        .showing-items { color: white; font-size: 16px; font-weight: 500; }
        .black-pagination .page-link:hover { background-color: #333; border-color: #333; }
        .black-pagination .active .page-link { background-color: #111; border-color: #111; }
        .row { margin-left: 0; margin-right: 0; }
        .row>.one { padding-left: 0; padding-right: 0; }
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
                    <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.php">PRODUCTS</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">ABOUT</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">CONTACT</a></li>
                    <li class="nav-item"><a class="nav-link active" href="shop.php">SHOP</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            <i class="fa-solid fa-cart-shopping"></i>CART
                            <span class="cart-counter">0</span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="fa-regular fa-user"></i>LOGIN</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- SEARCH SECTION -->
    <section class="search-section container my-5 py-5">
        <h2>FEATURED ITEMS</h2>
        <hr class="hr">
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search for products..." aria-label="Search for products">
            <button class="search-btn" aria-label="Search products">SEARCH</button>
        </div>
        <div class="category-container mt-3">
            <select class="category-select">
                <option value="">ALL CATEGORIES</option>
                <option value="cameras">CAMERAS</option>
                <option value="glasses">Glasses</option>
                <option value="guitars">Guitars</option>
                <option value="jackets">Jackets</option>
                <option value="shoes">Shoes</option>
                <option value="toys">Toys</option>
                <option value="watches">Watches</option>
            </select>
            <button class="filter-btn" aria-label="Filter products by category">FILTER</button>
            <button class="reset-btn" aria-label="Reset search and filter">RESET</button>
        </div>
        <div class="showing-items">Showing 12 item(s)</div>
    </section>

    <!-- OUR FEATURED SECTION -->
    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>OUR FEATURED</h3>
            <hr class="mx-auto">
            <p>HERE YOU CAN CHECK OUT OUR LATEST FEATURES</p>
        </div>
        <div class="container">
            <div class="row">

                <!-- PRODUCT 1 -->
                <div class="one col-lg-4 col-sm-12 p-0">
                    <img class="img-fluid" src="assets/images/BAPESTAS.JPG" alt="BAPESTAS" />
                    <div class="details text-center">
                        <h2>BAPESTAS</h2>
                        <p>R5000</p>
                        <div class="rating">
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                        </div>
                        <button class="btn btn-dark text-uppercase add-to-cart"
                                data-id="bapestas"
                                data-name="BAPESTAS"
                                data-price="150.00"
                                data-image="assets/images/BAPESTAS.JPG">ADD TO CART</button>
                        <button class="btn btn-success text-uppercase ms-2 buy-now-btn" data-id="bapestas">BUY NOW</button>
                    </div>
                </div>

                <!-- PRODUCT 2 -->
                <div class="one col-lg-4 col-sm-12 p-0">
                    <img class="img-fluid" src="assets/images/GOTH GUITER.JPG" alt="GOTH GUITER" />
                    <div class="details text-center">
                        <h2>GUITARS</h2>
                        <p>R6000</p>
                        <div class="rating">
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                        </div>
                        <button class="btn btn-dark text-uppercase add-to-cart"
                                data-id="goth-guitar"
                                data-name="GOTH GUITAR"
                                data-price="299.99"
                                data-image="assets/images/GOTH GUITER.JPG">ADD TO CART</button>
                        <button class="btn btn-success text-uppercase ms-2 buy-now-btn" data-id="goth-guitar">BUY NOW</button>
                    </div>
                </div>

                <!-- PRODUCT 3 -->
                <div class="one col-lg-4 col-sm-12 p-0">
                    <img class="img-fluid" src="assets/images/DESIGNER JACKET.JPG" alt="DESIGNER JACKET" />
                    <div class="details text-center">
                        <h2>DESIGNER JACKETS</h2>
                        <p>R6000</p>
                        <div class="rating">
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                        </div>
                        <button class="btn btn-dark text-uppercase add-to-cart"
                                data-id="designer-jacket"
                                data-name="DESIGNER JACKETS"
                                data-price="200.00"
                                data-image="assets/images/DESIGNER JACKET.JPG">ADD TO CART</button>
                        <button class="btn btn-success text-uppercase ms-2 buy-now-btn" data-id="designer-jacket">BUY NOW</button>
                    </div>
                </div>

                <!-- PRODUCT 4 -->
                <div class="one col-lg-4 col-sm-12 p-0">
                    <img class="img-fluid" src="assets/images/GREEN JACKET.JPEG" alt="GREEN JACKET" />
                    <div class="details text-center">
                        <h2>GREEN JACKETS</h2>
                        <p>R6000</p>
                        <div class="rating">
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                        </div>
                        <button class="btn btn-dark text-uppercase add-to-cart"
                                data-id="green-jacket"
                                data-name="GREEN JACKETS"
                                data-price="180.00"
                                data-image="assets/images/GREEN JACKET.JPEG">ADD TO CART</button>
                        <button class="btn btn-success text-uppercase ms-2 buy-now-btn" data-id="green-jacket">BUY NOW</button>
                    </div>
                </div>

                <!-- PRODUCT 5 -->
                <div class="one col-lg-4 col-sm-12 p-0">
                    <img class="img-fluid" src="assets/images/NEON BAPESTAS.JPG" alt="NEON BAPESTAS" />
                    <div class="details text-center">
                        <h2>NEON BAPESTAS</h2>
                        <p#type="text/javascript">R8000</p>
                        <div class="rating">
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                        </div>
                        <button class="btn btn-dark text-uppercase add-to-cart"
                                data-id="neon-bapestas"
                                data-name="NEON BAPESTAS"
                                data-price="170.00"
                                data-image="assets/images/NEON BAPESTAS.JPG">ADD TO CART</button>
                        <button class="btn btn-success text-uppercase ms-2 buy-now-btn" data-id="neon-bapestas">BUY NOW</button>
                    </div>
                </div>

                <!-- PRODUCT 6 -->
                <div class="one col-lg-4 col-sm-12 p-0">
                    <img class="img-fluid" src="assets/images/POLA-ROID.jpeg" alt="POLAROID CAMERAS" />
                    <div class="details text-center">
                        <h2>POLAROID CAMERAS</h2>
                        <p>R9000</p>
                        <div class="rating">
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                        </div>
                        <button class="btn btn-dark text-uppercase add-to-cart"
                                data-id="polaroid-camera"
                                data-name="POLAROID CAMERAS"
                                data-price="250.00"
                                data-image="assets/images/POLA-ROID.jpeg">ADD TO CART</button>
                        <button class="btn btn-success text-uppercase ms-2 buy-now-btn" data-id="polaroid-camera">BUY NOW</button>
                    </div>
                </div>

                <!-- PRODUCT 7 -->
                <div class="one col-lg-4 col-sm-12 p-0">
                    <img class="img-fluid" src="assets/images/GREEN--CAMERA.JPEG" alt="GREEN CAMERA" />
                    <div class="details text-center">
                        <h2>GREEN CAMERA</h2>
                        <p>R9000</p>
                        <div class="rating">
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                        </div>
                        <button class="btn btn-dark text-uppercase add-to-cart"
                                data-id="green-camera"
                                data-name="GREEN CAMERA"
                                data-price="250.00"
                                data-image="assets/images/GREEN--CAMERA.JPEG">ADD TO CART</button>
                        <button class="btn btn-success text-uppercase ms-2 buy-now-btn" data-id="green-camera">BUY NOW</button>
                    </div>
                </div>

                <!-- PRODUCT 8 -->
                <div class="one col-lg-4 col-sm-12 p-0">
                    <img class="img-fluid" src="assets/images/TOYS.JPEG" alt="TOYS" />
                    <div class="details text-center">
                        <h2>TOYS</h2>
                        <p>R2000</p>
                        <div class="rating">
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                        </div>
                        <button class="btn btn-dark text-uppercase add-to-cart"
                                data-id="toys"
                                data-name="TOYS"
                                data-price="50.00"
                                data-image="assets/images/TOYS.JPEG">ADD TO CART</button>
                        <button class="btn btn-success text-uppercase ms-2 buy-now-btn" data-id="toys">BUY NOW</button>
                    </div>
                </div>

                <!-- PRODUCT 9 -->
                <div class="one col-lg-4 col-sm-12 p-0">
                    <img class="img-fluid" src="assets/images/PATTEK ICE.JPEG" alt="ICE FROST WATCHES" />
                    <div class="details text-center">
                        <h2>ICE FROST WATCHES</h2>
                        <p>R10000</p>
                        <div class="rating">
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                        </div>
                        <button class="btn btn-dark text-uppercase add-to-cart"
                                data-id="ice-frost-watch"
                                data-name="ICE FROST WATCHES"
                                data-price="500.00"
                                data-image="assets/images/PATTEK ICE.JPEG">ADD TO CART</button>
                        <button class="btn btn-success text-uppercase ms-2 buy-now-btn" data-id="ice-frost-watch">BUY NOW</button>
                    </div>
                </div>

                <!-- PRODUCT 10 -->
                <div class="one col-lg-4 col-sm-12 p-0">
                    <img class="img-fluid" src="assets/images/FROST.JPG" alt="FROST WATCHES" />
                    <div class="details text-center">
                        <h2>FROST WATCHES</h2>
                        <p>R20000</p>
                        <div class="rating">
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                        </div>
                        <button class="btn btn-dark text-uppercase add-to-cart"
                                data-id="frost-watch"
                                data-name="FROST WATCHES"
                                data-price="480.00"
                                data-image="assets/images/FROST.JPG">ADD TO CART</button>
                        <button class="btn btn-success text-uppercase ms-2 buy-now-btn" data-id="frost-watch">BUY NOW</button>
                    </div>
                </div>

                <!-- PRODUCT 11 -->
                <div class="one col-lg-4 col-sm-12 p-0">
                    <img class="img-fluid" src="assets/images/ROLLIEEE.JPEG" alt="LUXURY WATCHES" />
                    <div class="details text-center">
                        <h2>LUXURY WATCHES</h2>
                        <p>R80000</p>
                        <div class="rating">
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                        </div>
                        <button class="btn btn-dark text-uppercase add-to-cart"
                                data-id="luxury-watch"
                                data-name="LUXURY WATCHES"
                                data-price="450.00"
                                data-image="assets/images/ROLLIEEE.JPEG">ADD TO CART</button>
                        <button class="btn btn-success text-uppercase ms-2 buy-now-btn" data-id="luxury-watch">BUY NOW</button>
                    </div>
                </div>

                <!-- PRODUCT 12 -->
                <div class="one col-lg-4 col-sm-12 p-0">
                    <img class="img-fluid" src="assets/images/PATTEK PHILIP.JPG" alt="PATTEK PHILIPPE WATCHES" />
                    <div class="details text-center">
                        <h2>PATTEK PHILIPP WATCHES</h2>
                        <p>R8000</p>
                        <div class="rating">
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                            <span class="star"><i class="fas fa-star"></i></span>
                        </div>
                        <button class="btn btn-dark text-uppercase add-to-cart"
                                data-id="pattek-philippe"
                                data-name="PATTEK PHILIPP WATCHES"
                                data-price="600.00"
                                data-image="assets/images/PATTEK PHILIP.JPG">ADD TO CART</button>
                        <button class="btn btn-success text-uppercase ms-2 buy-now-btn" data-id="pattek-philippe">BUY NOW</button>
                    </div>
                </div>

            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination mt-5 black-pagination justify-content-center">
                    <li class="page-item"><a class="page-link" href="#">PREVIOUS</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">NEXT</a></li>
                </ul>
            </nav>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <h5 class="footer-title">DRAGON STONE</h5>
                    <p class="footer-description">YOUR PREMIERE DESTINATION FOR PREMIUM SPORTS SHOES, LUXURY.</p>
                    <p class="footer-copyright">&copy; 2025 DRAGON STONE. ALL RIGHTS RESERVED.</p>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <h5 class="footer-title">CUSTOMER SERVICE</h5>
                    <div class="footer-links">
                        <a href="shipping.html"><i class="fas fa-truck"></i>SHIPPING POLICY</a>
                        <a href="returns.html"><i class="fas fa-exchange-alt"></i>RETURNS & EXCHANGES</a>
                        <a href="faq.html"><i class="fas fa-question-circle"></i>FAQs</a>
                        <a href="contact.php"><i class="fas fa-envelope"></i>CONTACT US</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                    <h5 class="footer-title">FOLLOW US</h5>
                    <img class="img-fluid" src="assets/images/IG.jpeg" alt="INSTAGRAM" style="width: 100px; height: auto;" />
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
                        <div class="input-group">
                            <input type="email" class="form-control newsletter-input" placeholder="Enter your email address" required>
                            <button class="btn newsletter-btn" type="button">SUBSCRIBE</button>
                        </div>
                        <small class="newsletter-text">GET THE LATEST UPDATES AND EXCLUSIVE OFFERS</small>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function updateCartCounter() {
            const counter = document.querySelector('.cart-counter');
            const total = cart.reduce((s, i) => s + i.quantity, 0);
            counter.textContent = total;
        }

        function addToCart(name, price, image, id) {
            const existing = cart.find(i => i.id === id);
            if (existing) existing.quantity += 1;
            else cart.push({ id, name, price: parseFloat(price), image, quantity: 1 });
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCounter();
            alert(`${name} has been added to your cart!`);
        }

        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const price = this.dataset.price;
                const image = this.dataset.image;
                addToCart(name, price, image, id);
            });
        });

        // BUY NOW: Go to single_product.php
        document.querySelectorAll('.buy-now-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                window.location.href = `single_product.php?product=${encodeURIComponent(id)}`;
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const itemCount = document.querySelectorAll('.one').length;
            document.querySelector('.showing-items').textContent = `Showing ${itemCount} item(s)`;
            updateCartCounter();
        });
    </script>
</body>
</html>