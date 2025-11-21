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
        <meta name="description" content="Register for a Dragon Stone account to access exclusive collections.">
        <meta property="og:title" content="Dragon Stone - Register">
        <meta property="og:description" content="Register for a Dragon Stone account to access exclusive collections.">
        <meta property="og:image" content="assets/images/GREEN.jpg">
        <meta property="og:url" content="https://www.dragonstone.com/register.html">
        <meta name="twitter:card" content="summary_large_image">
        <title>DRAGON STONE - REGISTER</title>
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
            
            .register-section {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            
            .register-card {
                background: rgba(0, 0, 0, 0.7);
                border: 1px solid #ffffff;
                border-radius: 10px;
                padding: 30px 25px;
                width: 100%;
                max-width: 500px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            }
            
            .register-card h2 {
                text-align: center;
                margin-bottom: 20px;
                color: #ffffff;
            }
            
            .register-card .form-control {
                background: rgba(255, 255, 255, 0.1);
                border: none;
                color: #ffffff;
            }
            
            .register-card .form-control:focus {
                background: rgba(255, 255, 255, 0.2);
                box-shadow: none;
                border-color: #a5c9a1;
            }
            
            .register-card .btn {
                width: 100%;
                margin-bottom: 10px;
                padding: 12px;
                background-color: #a5c9a1;
                border: none;
                color: #1b4d3e;
                transition: background-color 0.3s;
            }
            
            .register-card .btn:hover {
                background-color: #8ba888;
            }
            
            .message {
                text-align: center;
                margin-bottom: 15px;
                font-size: 0.85rem;
                padding: 10px;
                border-radius: 5px;
                transition: opacity 0.5s;
            }
            
            .message.success {
                color: #a5c9a1;
                background-color: rgba(165, 201, 161, 0.2);
            }
            
            .message.error {
                color: #ff6b6b;
                background-color: rgba(255, 107, 107, 0.2);
            }
            
            .login-link {
                color: #a5c9a1;
                text-decoration: none;
                text-align: center;
                display: block;
                margin-top: 10px;
            }
            
            .login-link:hover {
                text-decoration: underline;
            }
            
            .password-strength {
                font-size: 0.8rem;
                text-align: center;
                margin-bottom: 15px;
            }
            
            .password-strength.weak {
                color: #ff6b6b;
            }
            
            .password-strength.medium {
                color: #ffc107;
            }
            
            .password-strength.strong {
                color: #a5c9a1;
            }
        </style>
    </head>

    <body>
<!-- NAVBAR SECTION -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">DRAGON STONE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
            </ul>
        </div>
    </div>
</nav>

        <!-- REGISTER SECTION -->
        <section class="register-section">
            <div class="register-card">
                <h2>REGISTER</h2>
                <div id="register-message" class="message d-none"></div>
                <div id="password-strength" class="password-strength"></div>
                <form id="register-form">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required pattern="[a-zA-Z0-9_]+" title="Letters, numbers, and underscores only">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="register-email" name="register-email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="register-password" name="register-password" placeholder="Password" required minlength="8">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="register-confirm-password" name="register-confirm-password" placeholder="Confirm Password" required minlength="8">
                    </div>
                    <button type="submit" class="btn">REGISTER</button>
                    <a href="login.php" class="login-link">ALREADY HAVE AN ACCOUNT <strong>LOGIN</strong></a>
                </form>
            </div>
        </section>

        <!-- FOOTER SECTION -->
       <footer class="footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <h5 class="footer-title">DRAGON STONE</h5>
                        <p class="footer-description">YOUR PREMIER DESTINATION FOR PREMIUM SPORT SHOES,LUXERY WATHCES, AND STYLISH OUTWEAR.</p>
                        <p class="footer-copyright">&copy; 2025 DRAGON STONE STYLE. ALL RIGHTS RESERVED.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <h5 class="footer-title">CUSTOMER SERVICE</h5>
                        <div class="footer-links">
                            <a href="shipping.html" class="footer-link"><i class="fas fa-truck"></i>SHIPPING POLICY</a>
                            <a href="returns.html" class="footer-link"><i class="fas fa-exchange-alt"></i>RETURNS & EXCHANGES</a>
                            <a href="faq.html" class="footer-link"><i class="fas fa-question-circle"></i>FAQs</a>
                            <a href="contact.html" class="footer-link"><i class="fas fa-envelope"></i> CONTACT US</a>
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
        <!-- Custom JavaScript -->
        <script>
               // Initialize cart from localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function updateCartCounter() {
        const cartCounter = document.getElementById('cartCounter');
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartCounter.textContent = totalItems;
    }

    // Enhanced password strength checker
    function checkPasswordStrength(password) {
        const strengthDisplay = document.getElementById('password-strength');
        const specialChars = password.match(/[!@#$%^&*(),.?":{}|<>]/g) || [];
        const hasLetters = /[a-zA-Z]/.test(password);
        const hasNumbers = /[0-9]/.test(password);
        const specialCharCount = specialChars.length;

        if (password.length < 8) {
            strengthDisplay.textContent = 'Password too short (min 8 characters)';
            strengthDisplay.className = 'password-strength weak';
            return false;
        }

        if (!hasLetters || !hasNumbers || specialCharCount === 0) {
            let missing = [];
            if (!hasLetters) missing.push('letters');
            if (!hasNumbers) missing.push('numbers');
            if (specialCharCount === 0) missing.push('special characters');
            strengthDisplay.textContent = `Missing: ${missing.join(', ')}`;
            strengthDisplay.className = 'password-strength weak';
            return false;
        }

        if (specialCharCount === 1) {
            strengthDisplay.textContent = 'Medium strength – 1 special character';
            strengthDisplay.className = 'password-strength medium';
        } else {
            strengthDisplay.textContent = `Strong password – ${specialCharCount} special characters`;
            strengthDisplay.className = 'password-strength strong';
        }

        return true;
    }

    // Handle form submission
    document.getElementById('register-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const username = document.getElementById('username').value;
        const email = document.getElementById('register-email').value;
        const password = document.getElementById('register-password').value;
        const confirmPassword = document.getElementById('register-confirm-password').value;
        const message = document.getElementById('register-message');

        if (!username || !email || !password || !confirmPassword) {
            message.textContent = 'Please fill in all fields.';
            message.className = 'message error d-block';
            return;
        }

        if (!/^[a-zA-Z0-9_]+$/.test(username)) {
            message.textContent = 'Username can only contain letters, numbers, and underscores.';
            message.className = 'message error d-block';
            return;
        }

        if (password !== confirmPassword) {
            message.textContent = 'Passwords do not match.';
            message.className = 'message error d-block';
            return;
        }

        if (!checkPasswordStrength(password)) {
            message.textContent = 'Please use a stronger password.';
            message.className = 'message error d-block';
            return;
        }

        localStorage.setItem('username', username);
        message.textContent = 'Registration successful! Redirecting...';
        message.className = 'message success d-block';
        setTimeout(() => {
            window.location.href = 'account.html';
        }, 1000);
    });

    // Real-time password strength checking
    document.getElementById('register-password').addEventListener('input', function() {
        checkPasswordStrength(this.value);
    });

    document.addEventListener('DOMContentLoaded', function() {
        updateCartCounter();
    });
</script>


 