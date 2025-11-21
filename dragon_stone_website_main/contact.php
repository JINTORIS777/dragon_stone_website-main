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
        <meta name="description" content="Contact Dragon Stone for inquiries, support, and more. Reach us 24/7!">
        <title>DRAGON STONE CONTACT</title>
        <!-- Google Fonts: Lora & Roboto -->
        <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" />
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom Styles -->
        <style>
            body {
                background: url("assets/images/GREEN.jpg") no-repeat center center fixed;
                background-size: cover;
                margin: 0;
                padding: 0;
                font-family: 'Roboto', sans-serif;
                color: #ffffff;
                min-height: 100vh;
            }
            
            .heading-font {
                font-family: 'Lora', serif;
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
            /* Home Section */
            
            .home-section {
                padding: 150px 0;
                text-align: center;
                background-color: rgba(0, 0, 0, 0.4);
                border: 5px solid #ffffff;
                border-radius: 15px;
                margin-top: 100px;
            }
            
            .home-section h1 {
                text-shadow: 2px 2px 4px #000000;
                font-size: 3em;
                color: white;
            }
            
            .home-section p,
            .home-section h5 {
                color: white;
            }
            
            .home-section button {
                transition: all 0.3s ease;
            }
            
            .home-section button:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            }
            
            @media (max-width: 768px) {
                .home-section {
                    padding: 100px 0;
                }
                .home-section h1 {
                    font-size: 2em;
                }
                .home-section button {
                    padding: 10px 20px;
                    font-size: 1em;
                }
            }
            /* Featured Section */
            
            .one {
                position: relative;
                overflow: hidden;
            }
            
            .one img {
                transition: transform 0.3s ease;
            }
            
            .one:hover img {
                transform: scale(1.1);
            }
            
            .details {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: rgba(0, 0, 0, 0.7);
                padding: 10px;
                transform: translateY(100%);
                transition: transform 0.3s ease;
            }
            
            .one:hover .details {
                transform: translateY(0);
            }
            
            .star i {
                color: #ffd700;
            }
            /* Subscription Section */
            
            #subscription .card {
                background: rgba(0, 0, 0, 0.7);
                border: none;
                transition: transform 0.3s ease;
                color: #fff;
            }
            
            #subscription .card:hover {
                transform: translateY(-10px);
            }
            
            #subscription button:hover {
                background-color: #a5c9a1;
                color: #1b4d3e;
            }
            /* Footer */
            
            footer {
                background-color: #1b4d3e;
            }
            
            footer a:hover {
                color: #a5c9a1;
            }
            /* General text colors */
            
            h1,
            h3,
            h5,
            p {
                color: white;
            }
            
            h1.watches-title {
                text-align: center;
            }
            /* Minimized Contact Section (matching Login/Register aesthetic) */
            
            .contact-section {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            
            .contact-card {
                background: rgba(0, 0, 0, 0.7);
                border: 1px solid #ffffff;
                border-radius: 10px;
                padding: 30px 25px;
                width: 100%;
                max-width: 350px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
                text-align: center;
            }
            
            .contact-card h2 {
                margin-bottom: 20px;
                font-size: 1.5rem;
                color: #ffffff;
            }
            
            .contact-card .contact-info {
                margin-bottom: 15px;
                font-size: 0.9rem;
                color: #ffffff;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .contact-card .contact-info i {
                color: #a5c9a1;
                margin-right: 8px;
                font-size: 1rem;
            }
            
            .contact-card .contact-info a {
                color: #a5c9a1;
                text-decoration: none;
            }
            
            .contact-card .contact-info a:hover {
                color: #ffffff;
            }
            
            .contact-card hr {
                border-color: rgba(255, 255, 255, 0.3);
                margin: 20px 0;
            }
            
            @media (max-width: 768px) {
                .contact-card {
                    padding: 20px 15px;
                    max-width: 300px;
                }
            }
        </style>
    </head>

    <body>

        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.html">DRAGON STONE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
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
        <!-- Toast Container -->
        <div class="toast-container">
            <div class="toast" id="cartToast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Cart Updated</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Item added to cart!
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
                    <div class="modal-body">
                        <!-- Cart content will be populated by JavaScript -->
                    </div>
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


        <!-- MINIMIZED CONTACT SECTION -->
        <section class="contact-section">
            <div class="contact-card">
                <h2><i class="fas fa-envelope"></i>CONTACT US</h2>
                <hr class="mx-auto mb-3">
                <div class="contact-info"><i class="fas fa-phone"></i>011 640 3061</div>
                <div class="contact-info"><i class="fas fa-phone"></i>123 456 789</div>
                <div class="contact-info"><i class="fas fa-envelope"></i>EMAIL:<a href="mailto:info@email.com">info@email.com</a></div>
                <div class="contact-info"><i class="fas fa-clock"></i> WE WORK 24/7 TO ANSWER YOUR QUESTIONS</div>
            </div>
        </section>

        <!---CONTACT SECTION---->
        <section id="contact" class="container my-5 py-5">
            <div class="container text-center mt-5">



                <!-- FOOTER SECTION -->
                <footer class="footer-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <h5 class="footer-title">DRAGON STONE</h5>
                                <p class="footer-description">Your premier destination for premium sports shoes, luxury watches, and stylish outerwear.</p>
                                <p class="footer-copyright">&copy; 2025 Dragon Stone. All rights reserved.</p>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <h5 class="footer-title">CUSTOMER SERVICE</h5>
                                <div class="footer-links">
                                    <a href="shipping.html" class="footer-link"><i class="fas fa-truck"></i> SHIPPING POLICY</a>
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
    </body>

    </html>