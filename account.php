<?php
session_start();
require_once __DIR__ . DIRECTORY_SEPARATOR . 'user_functions.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'subscription_manager.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user = get_user_by_id($_SESSION['user_id']);
if (!$user) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Get user subscription information
$userSubscription = getUserSubscription($_SESSION['user_id']);
$availablePlans = getAvailablePlans();

// Check for success messages
$showLoginSuccess = isset($_SESSION['login_success']);
$showRegistrationSuccess = isset($_SESSION['registration_success']);

// Clear the flags
unset($_SESSION['login_success']);
unset($_SESSION['registration_success']);
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
                            <a class="nav-link" href="checkout.php">
                                <i class="fa-solid fa-cart-shopping"></i> CHECKOUT
                                <span class="cart-counter" id="cartCounter">0</span>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="account.php">
                                <i class="fa-regular fa-user"></i> <?php echo strtoupper(htmlspecialchars($user['user_name'] ?? 'ACCOUNT')); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fa-solid fa-sign-out-alt"></i> LOGOUT
                            </a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                <i class="fa-regular fa-user"></i> LOGIN
                            </a>
                        </li>
                        <?php endif; ?>
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
                <h2><i class="fas fa-user-circle me-2"></i>Welcome Back, <?php echo htmlspecialchars($user['user_name'] ?? 'User'); ?>!</h2>
                
                <?php if ($showLoginSuccess): ?>
                <div class="alert alert-success" style="background-color: rgba(144, 238, 144, 0.2); border: 1px solid #90EE90; color: #90EE90; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Login Successful!</strong> Welcome back to your Dragon Stone account.
                </div>
                <?php elseif ($showRegistrationSuccess): ?>
                <div class="alert alert-success" style="background-color: rgba(144, 238, 144, 0.2); border: 1px solid #90EE90; color: #90EE90; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    <i class="fas fa-user-plus me-2"></i>
                    <strong>Registration Successful!</strong> Your account has been created and you're now logged in.
                </div>
                <?php else: ?>
                <div class="alert" style="background-color: rgba(165, 201, 161, 0.2); border: 1px solid #a5c9a1; color: #a5c9a1; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Account Dashboard:</strong> Manage your Dragon Stone account and shopping preferences.
                </div>
                <?php endif; ?>
                
                <div class="user-info mb-4" style="background: rgba(255,255,255,0.1); padding: 25px; border-radius: 8px; border-left: 4px solid #a5c9a1;">
                    <h5 style="color: #a5c9a1; margin-bottom: 20px; font-size: 1.1rem;"><i class="fas fa-info-circle me-2"></i>Account Information</h5>
                    
                    <div style="margin-bottom: 12px; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                        <span style="display: inline-block; width: 130px; font-weight: 600; color: #a5c9a1;">Username:</span>
                        <span style="color: white; font-size: 1.05rem;"><?php echo htmlspecialchars($user['user_name'] ?? 'N/A'); ?></span>
                    </div>
                    
                    <div style="margin-bottom: 12px; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                        <span style="display: inline-block; width: 130px; font-weight: 600; color: #a5c9a1;">Email:</span>
                        <span style="color: white; font-size: 1.05rem;"><?php echo htmlspecialchars($user['email'] ?? 'N/A'); ?></span>
                    </div>
                    
                    <div style="margin-bottom: 12px; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                        <span style="display: inline-block; width: 130px; font-weight: 600; color: #a5c9a1;">Phone:</span>
                        <span style="color: white; font-size: 1.05rem;"><?php echo htmlspecialchars($user['phone_number'] ?? 'N/A'); ?></span>
                    </div>
                    
                    <?php if (isset($user['created_at'])): ?>
                    <div style="margin-bottom: 12px; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                        <span style="display: inline-block; width: 130px; font-weight: 600; color: #a5c9a1;">Member Since:</span>
                        <span style="color: white; font-size: 1.05rem;"><?php echo date('F j, Y', strtotime($user['created_at'])); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <div style="margin-bottom: 12px; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                        <span style="display: inline-block; width: 130px; font-weight: 600; color: #a5c9a1;">Account Status:</span>
                        <span style="color: #90EE90; font-weight: 600;"><i class="fas fa-circle me-1" style="font-size: 0.7rem;"></i>Active</span>
                    </div>
                    
                    <div style="margin-bottom: 12px; padding: 10px 0;">
                        <span style="display: inline-block; width: 130px; font-weight: 600; color: #a5c9a1;">Account ID:</span>
                        <span style="color: #ccc; font-family: monospace; font-size: 0.9rem;"><?php echo htmlspecialchars($user['id'] ?? 'N/A'); ?></span>
                    </div>
                </div>
                
                <div style="background: rgba(255,255,255,0.1); padding: 25px; border-radius: 8px; border-left: 4px solid #a5c9a1; margin-bottom: 20px;">
                    <h5 style="color: #a5c9a1; margin-bottom: 20px; font-size: 1.1rem;"><i class="fas fa-crown me-2"></i>Subscription Details</h5>
                    
                    <?php if ($userSubscription): ?>
                        <div style="margin-bottom: 12px; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <span style="display: inline-block; width: 130px; font-weight: 600; color: #a5c9a1;">Plan:</span>
                            <span style="color: white; font-size: 1.05rem;"><?php echo htmlspecialchars($userSubscription['plan_name']); ?></span>
                            <?php if ($userSubscription['plan_id'] === 'free'): ?>
                                <span class="badge bg-secondary ms-2">Free</span>
                            <?php elseif ($userSubscription['plan_id'] === 'premium'): ?>
                                <span class="badge bg-warning ms-2">Premium</span>
                            <?php else: ?>
                                <span class="badge bg-success ms-2">VIP</span>
                            <?php endif; ?>
                        </div>
                        
                        <div style="margin-bottom: 12px; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <span style="display: inline-block; width: 130px; font-weight: 600; color: #a5c9a1;">Status:</span>
                            <span style="color: #90EE90; font-weight: 600;"><?php echo ucfirst($userSubscription['status']); ?></span>
                        </div>
                        
                        <?php if ($userSubscription['expires_at']): ?>
                        <div style="margin-bottom: 12px; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <span style="display: inline-block; width: 130px; font-weight: 600; color: #a5c9a1;">Expires:</span>
                            <span style="color: white;"><?php echo date('F j, Y', strtotime($userSubscription['expires_at'])); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <div style="margin-bottom: 12px; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.2);">
                            <span style="display: inline-block; width: 130px; font-weight: 600; color: #a5c9a1;">Monthly Cost:</span>
                            <span style="color: white;">R<?php echo number_format($userSubscription['price'], 2); ?></span>
                        </div>
                        
                        <div style="margin-bottom: 0; padding: 10px 0;">
                            <span style="display: inline-block; width: 130px; font-weight: 600; color: #a5c9a1;">Benefits:</span>
                            <div style="margin-top: 5px;">
                                <?php 
                                $plan = $availablePlans[$userSubscription['plan_id']];
                                foreach ($plan['features'] as $feature): ?>
                                    <small style="display: block; color: #ccc; margin-bottom: 3px;"><i class="fas fa-check text-success me-1"></i><?php echo $feature; ?></small>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning" style="background-color: rgba(255, 193, 7, 0.2); border: 1px solid #ffc107; color: #ffc107;">
                            <i class="fas fa-exclamation-triangle me-2"></i>No active subscription found.
                        </div>
                    <?php endif; ?>
                </div>
                
                <div style="background: rgba(255,255,255,0.05); padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                    <h5 style="color: #a5c9a1; margin-bottom: 15px; font-size: 1.1rem;"><i class="fas fa-shopping-bag me-2"></i>Quick Actions</h5>
                    <div class="d-grid gap-2">
                        <a href="shop.php" class="btn" style="background-color: #a5c9a1; color: #1b4d3e; border: none; padding: 12px 20px; font-weight: 600; border-radius: 6px; text-decoration: none; transition: all 0.3s ease;">
                            <i class="fas fa-store me-2"></i>Continue Shopping
                        </a>
                        <?php if ($userSubscription && $userSubscription['plan_id'] === 'free'): ?>
                        <a href="subscription.php" class="btn" style="background-color: rgba(255, 193, 7, 0.8); color: #1b4d3e; border: none; padding: 12px 20px; font-weight: 600; border-radius: 6px; text-decoration: none; transition: all 0.3s ease;">
                            <i class="fas fa-crown me-2"></i>Upgrade Plan
                        </a>
                        <?php elseif ($userSubscription && $userSubscription['plan_id'] === 'premium'): ?>
                        <a href="subscription.php" class="btn" style="background-color: rgba(40, 167, 69, 0.8); color: white; border: none; padding: 12px 20px; font-weight: 600; border-radius: 6px; text-decoration: none; transition: all 0.3s ease;">
                            <i class="fas fa-gem me-2"></i>Upgrade to VIP
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div style="background: rgba(255,255,255,0.05); padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <h6 style="color: #a5c9a1; margin-bottom: 10px;"><i class="fas fa-chart-line me-2"></i>Account Summary</h6>
                    <div class="row text-center">
                        <div class="col-4">
                            <div style="color: white;">
                                <strong id="cartItemCount">0</strong><br>
                                <small style="color: #ccc;">Items Ready</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="color: white;">
                                <strong style="color: #90EE90;">Active</strong><br>
                                <small style="color: #ccc;">Account</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="color: white;">
                                <strong><?php echo isset($user['created_at']) ? date('M Y', strtotime($user['created_at'])) : 'N/A'; ?></strong><br>
                                <small style="color: #ccc;">Joined</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <a href="logout.php" class="btn btn-outline-light" style="padding: 10px 25px; border-radius: 6px; text-decoration: none; transition: all 0.3s ease;">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </div>
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
                const cartItemCount = document.getElementById('cartItemCount');
                const totalItems = cart.length;
                if (cartCounter) cartCounter.textContent = totalItems;
                if (cartItemCount) cartItemCount.textContent = totalItems;
            }

            // Update cart counter on page load
            document.addEventListener('DOMContentLoaded', function() {
                updateCartCounter();
                
                // Add smooth hover effects to buttons
                const buttons = document.querySelectorAll('.btn');
                buttons.forEach(btn => {
                    btn.addEventListener('mouseenter', function() {
                        if (this.style.backgroundColor.includes('165, 201, 161')) {
                            this.style.transform = 'translateY(-2px)';
                            this.style.boxShadow = '0 4px 8px rgba(0,0,0,0.2)';
                        }
                    });
                    btn.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0)';
                        this.style.boxShadow = 'none';
                    });
                });
                
                // Auto-hide success message after 5 seconds
                const successAlert = document.querySelector('.alert');
                if (successAlert && successAlert.textContent.includes('Login Successful')) {
                    setTimeout(() => {
                        successAlert.style.opacity = '0';
                        setTimeout(() => {
                            successAlert.style.display = 'none';
                        }, 300);
                    }, 5000);
                }
            });
        </script>
    </body>

    </html>