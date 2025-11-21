<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
//include('../server/connection.php');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Log in to your Dragon Stone account to access exclusive collections.">
        <meta property="og:title" content="Dragon Stone - Login">
        <meta property="og:description" content="Log in to your Dragon Stone account to access exclusive collections.">
        <meta property="og:image" content="assets/images/GREEN.jpg">
        <meta property="og:url" content="https://www.dragonstone.com/login.html">
        <meta name="twitter:card" content="summary_large_image">
        <title>DRAGON STONE - Login</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" />
        <!-- Custom Styles -->
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
            .navbar-custom .fa-user,
            .navbar-custom .fa-envelope {
                color: #ffffff;
            }
            
            .cart-counter {
                position: absolute;
                top: -10px;
                right: -10px;
                background: red;
                color: white;
                border-radius: 50%;
                padding: 2px 6px;
                font-size: 12px;
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
            
            .footer-description {
                font-size: 14px;
                margin-bottom: 10px;
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
            
            .social-icons {
                margin-top: 15px;
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
            
            .newsletter-form {
                margin-top: 20px;
            }
            
            .newsletter-input {
                border: none;
                border-radius: 5px 0 0 5px;
            }
            
            .newsletter-btn {
                background-color: #a5c9a1;
                color: #1b4d3e;
                border: none;
                border-radius: 0 5px 5px 0;
                padding: 10px 20px;
            }
            
            .newsletter-text {
                color: #a5c9a1;
                font-size: 12px;
                margin-top: 5px;
                display: block;
            }
            
            .footer-copyright {
                font-size: 12px;
                color: #a5c9a1;
                margin-top: 20px;
            }
            
            .footer-social-img {
                width: 100px;
                height: auto;
                border-radius: 5px;
                margin-bottom: 10px;
            }
            
            .login-section {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            
            .login-card {
                background: rgba(0, 0, 0, 0.7);
                border: 1px solid #ffffff;
                border-radius: 10px;
                padding: 30px;
                width: 100%;
                max-width: 500px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            }
            
            .login-card h2 {
                text-align: center;
                margin-bottom: 20px;
                color: #ffffff;
            }
            
            .login-card .form-label {
                color: #ffffff;
                font-weight: 500;
            }
            
            .login-card .form-control {
                background: rgba(255, 255, 255, 0.1);
                border: none;
                color: #ffffff;
            }
            
            .login-card .form-control:focus {
                background: rgba(255, 255, 255, 0.2);
                box-shadow: none;
                border-color: #a5c9a1;
            }
            
            .login-btn {
                background-color: #a5c9a1;
                color: #1b4d3e;
                border: none;
                border-radius: 5px;
                padding: 12px;
                font-weight: 500;
                transition: background-color 0.3s ease;
                width: 100%;
            }
            
            .login-btn:hover {
                background-color: #8ba888;
            }
            
            .signup-link {
                color: #a5c9a1;
                text-decoration: none;
                text-align: center;
                display: block;
                margin-top: 10px;
            }
            
            .signup-link:hover {
                text-decoration: underline;
            }
        </style>
    </head>

    <body>
        <!-- Navbar Section -->
        <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.php">DRAGON STONE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
                        <li class="nav-item"><a class="nav-link" href="products.php">PRODUCTS</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">ABOUT</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">CONTACT</a></li>
                        <li class="nav-item"><a class="nav-link" href="shop.php">SHOP</a></li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">
                                <i class="fa-solid fa-cart-shopping"></i> CART
                                <span class="cart-counter" id="cartCounter">0</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="login.php">
                                <i class="fa-regular fa-user"></i> LOGIN
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">
                                <i class="fa-regular fa-envelope"></i> CONTACT
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Login Section -->
        <section class="login-section">
            <div class="login-card">
                <h2>LOGIN</h2>
                <form id="loginForm">
                    <div class="mb-3">
                        <label for="username" class="form-label">USERNAME</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter your username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">PASSWORD</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="login-btn">LOGIN</button>
                </form>
                <a href="signup.html" class="signup-link">Don't have an account? Sign up</a>
            </div>
        </section>

        <!-- Footer Section -->
        <footer class="footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <h5 class="footer-title">DRAGON STONE</h5>
                        <p class="footer-description">Your premier destination for premium sports shoes, luxury watches, and stylish outerwear.</p>
                        <p class="footer-copyright">&copy; 2025 Dragon Stone. All rights reserved.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <h5 class="footer-title">Customer Service</h5>
                        <div class="footer-links">
                            <a href="shipping.html" class="footer-link"><i class="fas fa-truck"></i>Shipping Policy</a>
                            <a href="returns.html" class="footer-link"><i class="fas fa-exchange-alt"></i>Returns & Exchanges</a>
                            <a href="faqs.html" class="footer-link"><i class="fas fa-question-circle"></i>FAQs</a>
                            <a href="contact.html" class="footer-link"><i class="fas fa-envelope"></i>CONTACT US</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                        <h5 class="footer-title">FOLLOW US</h5>
                        <img class="footer-social-img" src="assets/images/IG.jpeg" alt="Instagram">
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
                            <form action="subscribe.html" method="POST">
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control newsletter-input" placeholder="Enter your email address" required>
                                    <button class="btn newsletter-btn" type="submit">SUBSCRIBE</button>
                                </div>
                                <small class="newsletter-text">GET THE LATEST UPDATES AND EXCLUSIVE OFFERS</small>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Custom JavaScript -->
        <script>
            // Initialize cart from localStorage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Update cart counter
            function updateCartCounter() {
                const cartCounter = document.getElementById('cartCounter');
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                cartCounter.textContent = totalItems;
            }

            // Handle form submission
            document.getElementById('loginForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                if (username && password) {
                    localStorage.setItem('username', username);
                    alert('Login successful!');
                    window.location.href = 'account.php';
                } else {
                    alert('Please enter both username and password.');
                }
            });

            // Update cart counter on page load
            document.addEventListener('DOMContentLoaded', function() {
                updateCartCounter();
            });
        </script>
    </body>

    </html>