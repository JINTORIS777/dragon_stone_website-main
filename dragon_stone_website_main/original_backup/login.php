<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
//include('../server/configure.php');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DRAGON STONE LOGIN</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" />
        <!-- Custom Styles -->
        <style>
            body {
                background: url("assets/images/GREEN.jpg") no-repeat center center fixed;
                background-size: cover;
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
                color: #ffffff;
                min-height: 100vh;
            }
            
            .navbar-custom {
                background-color: #1b4d3e;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
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
                transition: color 0.3s ease;
            }
            
            .navbar-custom .fa-cart-shopping:hover,
            .navbar-custom .fa-user:hover {
                color: #a5c9a1;
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
                padding: 30px 25px;
                width: 100%;
                max-width: 350px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            }
            
            .login-card h2 {
                text-align: center;
                margin-bottom: 20px;
                font-size: 1.5rem;
            }
            
            .login-card .form-control {
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid #ffffff;
                color: #ffffff;
                margin-bottom: 15px;
                font-size: 0.9rem;
                padding: 8px 12px;
            }
            
            .login-card .form-control::placeholder {
                color: rgba(255, 255, 255, 0.7);
            }
            
            .login-card .form-control:focus {
                background: rgba(255, 255, 255, 0.2);
                border-color: #a5c9a1;
                color: #ffffff;
                box-shadow: none;
            }
            
            .login-card .btn {
                width: 100%;
                margin-bottom: 10px;
                padding: 8px;
                font-size: 0.9rem;
                background-color: #1b4d3e;
                border: 1px solid #ffffff;
                color: #ffffff;
                position: relative;
            }
            
            .login-card .btn:hover {
                background-color: #a5c9a1;
                color: #1b4d3e;
            }
            
            .login-card .register-link {
                text-align: center;
                color: #a5c9a1;
                text-decoration: none;
                font-size: 0.85rem;
            }
            
            .login-card .register-link:hover {
                color: #ffffff;
            }
            
            .alert {
                margin-top: 15px;
                font-size: 0.85rem;
                padding: 10px;
            }
            
            .password-toggle {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                color: #a5c9a1;
            }
            
            .password-toggle:hover {
                color: #ffffff;
            }
            
            .spinner {
                display: none;
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                width: 20px;
                height: 20px;
                border: 2px solid #ffffff;
                border-top: 2px solid #a5c9a1;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }
            
            @keyframes spin {
                0% {
                    transform: translateY(-50%) rotate(0deg);
                }
                100% {
                    transform: translateY(-50%) rotate(360deg);
                }
            }
            
            @media (max-width: 768px) {
                .login-card {
                    padding: 20px 15px;
                    max-width: 300px;
                }
            }
        </style>
    </head>

    <body>
    <!-- NAVBAR SECTION -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">DRAGON STONE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">ABOUT</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">CONTACT</a></li>
                <li class="nav-item"><a class="nav-link" href="shop.php">SHOP</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        <i class="fa-solid fa-cart-shopping"></i>CART
                        <span class="cart-counter" id="cartCounter">0</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="login.php">
                        <i class="fa-regular fa-user"></i>LOGIN
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


        <!-- LOGIN SECTION -->
        <section class="login-section">
            <div class="login-card">
                <h2>LOGIN</h2>
                <hr class="mx-auto mb-3" style="border-color: rgba(255,255,255,0.3);">
                <form id="login-form">
                    <div class="mb-2">
                        <label for="login-email" class="form-label">EMAIL</label>
                        <input type="email" class="form-control" id="login-email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="login-password" class="form-label">PASSWORD</label>
                        <input type="password" class="form-control" id="login-password" name="password" placeholder="Enter password" required>
                        <i class="fas fa-eye password-toggle" id="toggle-password"></i>
                    </div>
                    <button type="submit" class="btn" id="login-btn">
                    LOGIN
                    <span class="spinner" id="login-spinner"></span>
                </button>
                    <a href="register.php" class="btn register-link">DON'T HAVE AN ACCOUNT? REGISTER</a>
                    <div id="login-alert" class="alert d-none"></div>
                </form>
            </div>
        </section>


        <!-- FOOTER SECTION -->
        <footer class="footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <h5 class="footer-title">DRAGON STONE</h5>
                        <p class="footer-description">YOUR PREMEIRE DESTINATION FOR PREMIUM SPORT SHOES, LUXERY WATCHES, AND STYLISH OUTERWEAR.</p>
                        <p class="footer-copyright">&copy; 2025 DRAGON STONE .</p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <h5 class="footer-title">CUSTOMER SERVICE</h5>
                        <div class="footer-links">
                            <a href="shipping.html" class="footer-link"><i class="fas fa-truck"></i>SHIPPING POLICY</a>
                            <a href="returns.html" class="footer-link"><i class="fas fa-exchange-alt"></i>RETURNS & EXCHANGES</a>
                            <a href="faq.html" class="footer-link"><i class="fas fa-question-circle"></i>FAQs</a>
                            <a href="contact.php" class="footer-link"><i class="fas fa-envelope"></i>CONTACT US</a>
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
                    <hr class="footer-divider">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="newsletter-form text-center">
                                <h6>SUBSCRIBE TO OUR NEWSLETTER</h6>
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control newsletter-input" placeholder="Enter your email address" required>
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
        <!-- Custom JS -->
        <script src="login.js"></script>
    </body>

    </html>