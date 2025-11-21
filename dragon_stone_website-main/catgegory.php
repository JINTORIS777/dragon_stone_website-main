<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
include('/server/configure.php');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Shop Glasses at Dragon Stone - Premium eyewear with style and protection.">
        <title>Glasses - DRAGON STONE</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" />
        <!-- Custom Styles (Same as index) -->
        <style>
            body {
                background-image: url('assets/images/GREEN.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
                min-height: 100vh;
            }
            
            .navbar-custom {
                background-color: #1b4d3e;
            }
            
            .navbar-custom .navbar-brand,
            .navbar-custom .nav-link {
                color: #ffffff;
                font-weight: 500;
                transition: color 0.3s ease;
            }
            
            .navbar-custom .nav-link:hover {
                color: #a5c9a1;
            }
            
            .navbar-custom .fa-cart-shopping,
            .navbar-custom .fa-user {
                color: #ffffff;
            }
            
            .star.filled .fas.fa-star {
                color: yellow;
            }
            
            .star.empty .fas.fa-star {
                color: #ccc;
            }
            
            .cart-counter {
                position: absolute;
                top: -10px;
                right: -10px;
                background: green;
                color: white;
                border-radius: 50%;
                padding: 2px 6px;
                font-size: 12px;
            }
            
            .one {
                position: relative;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                border-radius: 12px;
                background: rgba(27, 77, 62, 0.9);
            }
            
            .one:hover {
                transform: translateY(-10px);
                box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
            }
            
            .one img {
                transition: transform 0.3s ease;
                border-radius: 12px 12px 0 0;
            }
            
            .one:hover img {
                transform: scale(1.05);
            }
            
            .details {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
                color: white;
                padding: 20px 15px 15px;
                border-radius: 0 0 12px 12px;
                transform: translateY(10px);
                transition: transform 0.3s ease;
            }
            
            .one:hover .details {
                transform: translateY(0);
            }
            
            .category-header {
                background: rgba(27, 77, 62, 0.95);
                border-radius: 15px;
                padding: 30px;
                margin-bottom: 40px;
                text-align: center;
                color: white;
            }
            
            .filter-btn {
                background: #a5c9a1;
                color: #1b4d3e;
                border: none;
                padding: 8px 16px;
                margin: 0 5px 10px;
                border-radius: 50px;
                font-size: 14px;
                transition: all 0.3s ease;
            }
            
            .filter-btn.active,
            .filter-btn:hover {
                background: white;
                color: #1b4d3e;
                transform: translateY(-2px);
            }
            
            .footer-section {
                background-color: #1b4d3e;
                color: white;
                padding: 40px 0 20px;
            }
            
            .footer-title {
                font-weight: bold;
                margin-bottom: 15px;
            }
            
            .footer-links a {
                display: block;
                color: #a5c9a1;
                text-decoration: none;
                margin-bottom: 8px;
                transition: color 0.3s ease;
            }
            
            .footer-links a:hover {
                color: white;
            }
            
            .social-icons a {
                color: white;
                font-size: 20px;
                margin-right: 15px;
                transition: color 0.3s ease;
            }
            
            .social-icons a:hover {
                color: #a5c9a1;
            }
            
            .footer-divider {
                border-color: #a5c9a1;
                margin: 30px 0;
            }
            
            .newsletter-btn {
                background-color: #a5c9a1;
                color: #1b4d3e;
                border: none;
                border-radius: 0 5px 5px 0;
                padding: 10px 20px;
            }
            
            h1,
            h2,
            h3,
            h5,
            p {
                color: white;
            }
            
            html {
                scroll-behavior: smooth;
            }
            
            .toast-container {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1050;
            }
            
            .no-products {
                text-align: center;
                padding: 60px 20px;
                color: #ccc;
                font-size: 1.2rem;
            }
        </style>
    </head>

    <body>
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.php">DRAGON STONE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php#home">HOME</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">ABOUT</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.html">CONTACT</a></li>
                        <li class="nav-item"><a class="nav-link" href="shop.html">SHOP</a></li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#cartModal">
                                <i class="fa-solid fa-cart-shopping"></i> CART
                                <span class="cart-counter" id="cartCounter">0</span>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa-regular fa-user"></i> LOGIN</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Toast -->
        <div class="toast-container">
            <div class="toast" id="cartToast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">CART UPDATED</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ITEM ADDED TO CART
                </div>
            </div>
        </div>

        <!-- CART MODAL -->
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">YOUR CART</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                        <button type="button" class="btn btn-primary">CHECKOUT</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">LOGIN</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">USERNAME</label>
                            <input type="text" class="form-control" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">PASSWORD</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="handleLogin()">LOGIN</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- CATEGORY HEADER -->
        <section class="mt-5 pt-5">
            <div class="container">
                <div class="category-header">
                    <h1>CATEGORY COLLECTION</h1>
                    <p>PREMIUM WITH UV PROTECTION AND UNMATCHED STYLE</p>
                </div>

                <!-- FILTER BUTTONS -->
                <div class="text-center mb-5">
                    <button class="filter-btn active" data-filter="all">ALL</button>
                    <button class="filter-btn" data-filter="BAPESTAS">BAPESTAS</button>
                    <button class="filter-btn" data-filter="JACKETS">JACKETS</button>
                    <button class="filter-btn" data-filter="WACTHES">WACTHES</button>
                    <button class="filter-btn" data-filter="TOYS">TOYS</button>

                </div>

                <!-- PRODUCT GRID -->
                <div class="row" id="productGrid">
                    <!-- Product 1 -->
                    <div class="col-lg-4 col-md-6 mb-4 product-item" data-category="sunglasses luxury">
                        <div class="one">
                            <img src="assets/images/BAPESTAS.JPG" class="img-fluid" alt="BAPESTAS">
                            <div class="details text-center">
                                <h4>BAPESTAS</h4>
                                <div class="rating" data-rating="4">
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                </div>
                                <p class="mb-2">$199.99</p>
                                <button class="btn btn-dark text-uppercase w-100" data-product="Gucci Sunglasses" data-price="199.99">
                                ADD TO CART
                            </button>
                            </div>
                        </div>
                    </div>

                    <!-- PRODUCTS 2-->
                    <div class="col-lg-4 col-md-6 mb-4 product-item" data-category="eyeglasses">
                        <div class="one">
                            <img src="assets/images/POLA-ROID.jpeg" class="img-fluid" alt="CAMERA">
                            <div class="details text-center">
                                <h4>POLAROID CAMERA</h4>
                                <div class="rating" data-rating="5">
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                </div>
                                <p class="mb-2">$149.99</p>
                                <button class="btn btn-dark text-uppercase w-100" data-product="Polaroid Eyeglasses" data-price="149.99">
                                ADD TO CART
                            </button>
                            </div>
                        </div>
                    </div>

                    <!-- PRODUCTS 3 -->
                    <div class="col-lg-4 col-md-6 mb-4 product-item" data-category="sunglasses">
                        <div class="one">
                            <img src="assets/images/TOYS.JPEG" class="img-fluid" alt="TOYS">
                            <div class="details text-center">
                                <h4>TOYS</h4>
                                <div class="rating" data-rating="4">
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                </div>
                                <p class="mb-2">$89.99</p>
                                <button class="btn btn-dark text-uppercase w-100" data-product="TOYS" data-price="89.99">
                                ADD TO CART
                            </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 product-item" data-category="sunglasses luxury">
                        <div class="one">
                            <img src="assets/images/GOTH GUITER.JPG" class="img-fluid" alt="GUITER.JPG">
                            <div class="details text-center">
                                <h4>GUITERs</h4>
                                <div class="rating" data-rating="4">
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                </div>
                                <p class="mb-2">$199.99</p>
                                <button class="btn btn-dark text-uppercase w-100" data-product="GUITERS" data-price="199.99">
                                ADD TO CART
                            </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 product-item" data-category="sunglasses luxury">
                        <div class="one">
                            <img src="assets/images/BAPESTAS.JPG" class="img-fluid" alt="BAPESTAS">
                            <div class="details text-center">
                                <h4></h4>
                                <div class="rating" data-rating="4">
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                </div>
                                <p class="mb-2">$199.99</p>
                                <button class="btn btn-dark text-uppercase w-100" data-product="Gucci Sunglasses" data-price="199.99">
                                ADD TO CART
                            </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 product-item" data-category="sunglasses luxury">
                        <div class="one">
                            <img src="assets/images/BAPESTAS.JPG" class="img-fluid" alt="BAPESTAS">
                            <div class="details text-center">
                                <h4>BAPESTAS</h4>
                                <div class="rating" data-rating="4">
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span class="star"><i class="fas fa-star"></i></span>
                                </div>
                                <p class="mb-2">$199.99</p>
                                <button class="btn btn-dark text-uppercase w-100" data-product="Gucci Sunglasses" data-price="199.99">
                                ADD TO CART
                            </button>
                            </div>
                        </div>
                    </div>

                    <!-- Add more products as needed -->
                </div>

                <div id="noResults" class="no-products" style="display: none;">
                    <p>NO PRODUCTS FOUND IN THIS CATEGORY.</p>
                </div>
            </div>
        </section>

        <!-- FOOTER (Same as index) -->
        <footer class="footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <h5 class="footer-title">DRAGON STONE</h5>
                        <p class="footer-description">YOUR PREIMIER DESTINATION FOR PREMIUM SPORTS SHOES, lUXERY WATCHES, AND STYLISH OUTER.</p>
                        <p class="footer-copyright">© 2025 DRAGON STONE. ALL RIGHTS RESERVED.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <h5 class="footer-title">CUSTOMER SERVICE</h5>
                        <div class="footer-links">
                            <a href="shipping.html"><i class="fas fa-truck"></i>SHIPPING POLICY</a>
                            <a href="returns.html"><i class="fas fa-exchange-alt"></i>RETURNS & EXCHANGES</a>
                            <a href="faq.html"><i class="fas fa-question-circle"></i>FAQs</a>
                            <a href="contact.html"><i class="fas fa-envelope"></i>CONTACT US</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                        <h5 class="footer-title">FOLLOW US</h5>
                        <div>
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
                </div>
                <hr class="footer-divider">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="newsletter-form text-center">
                            <h6>SUBSCRIBE TO OUR NEWSLETTER</h6>
                            <div class="input-group">
                                <input type="email" class="form-control newsletter-input" placeholder="Enter your email address" required>
                                <button class="btn newsletter-btn" type="button" onclick="handleNewsletter()">SUBSCRIBE</button>
                            </div>
                            <small class="newsletter-text">GET THE LATEST UPDATES AND EXCLUSIVE OFFERS</small>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Active Nav
                const currentPath = window.location.pathname.split('/').pop();
                document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
                    const href = link.getAttribute('href').split('/').pop();
                    if (href === currentPath) link.classList.add('active');
                    else link.classList.remove('active');
                });

                // Star Ratings
                document.querySelectorAll('.rating').forEach(rating => {
                    const stars = rating.querySelectorAll('.star');
                    const value = parseInt(rating.getAttribute('data-rating'));
                    stars.forEach((star, i) => {
                        star.classList.add(i < value ? 'filled' : 'empty');
                    });
                });

                // Filter Functionality
                const filterBtns = document.querySelectorAll('.filter-btn');
                const productItems = document.querySelectorAll('.product-item');
                const noResults = document.getElementById('noResults');

                filterBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const filter = btn.getAttribute('data-filter');

                        // Update active button
                        filterBtns.forEach(b => b.classList.remove('active'));
                        btn.classList.add('active');

                        let visible = 0;
                        productItems.forEach(item => {
                            const categories = item.getAttribute('data-category').split(' ');
                            if (filter === 'all' || categories.includes(filter)) {
                                item.style.display = 'block';
                                visible++;
                            } else {
                                item.style.display = 'none';
                            }
                        });

                        noResults.style.display = visible === 0 ? 'block' : 'none';
                    });
                });

                // Add to Cart
                document.querySelectorAll('[data-product]').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const product = btn.getAttribute('data-product');
                        const price = parseFloat(btn.getAttribute('data-price'));
                        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                        cart.push({
                            name: product,
                            price
                        });
                        localStorage.setItem('cart', JSON.stringify(cart));
                        document.getElementById('cartCounter').textContent = cart.length;

                        const toast = new bootstrap.Toast(document.getElementById('cartToast'));
                        document.querySelector('#cartToast .toast-body').textContent = `${product} added!`;
                        toast.show();
                    });
                });

                // Cart Modal
                document.getElementById('cartModal').addEventListener('show.bs.modal', () => {
                    const items = JSON.parse(localStorage.getItem('cart') || '[]');
                    const body = document.querySelector('#cartModal .modal-body');
                    body.innerHTML = items.length ?
                        items.map(i => `<p>${i.name} - $${i.price.toFixed(2)}</p>`).join('') :
                        '<p>Your cart is empty.</p>';
                    document.getElementById('cartCounter').textContent = items.length;
                });

                // Login
                window.handleLogin = function() {
                    const username = document.getElementById('username').value;
                    const password = document.getElementById('password').value;
                    console.log('Login:', {
                        username,
                        password
                    });
                    bootstrap.Modal.getInstance(document.getElementById('loginModal')).hide();
                };

                // Newsletter
                window.handleNewsletter = function() {
                    const email = document.querySelector('.newsletter-input').value.trim();
                    if (email) {
                        console.log('Subscribed:', email);
                        document.querySelector('.newsletter-input').value = '';
                        const toast = new bootstrap.Toast(document.getElementById('cartToast'));
                        document.querySelector('#cartToast .toast-body').textContent = 'Subscribed!';
                        toast.show();
                    }
                };
            });
        </script>
    </body>

    </html>