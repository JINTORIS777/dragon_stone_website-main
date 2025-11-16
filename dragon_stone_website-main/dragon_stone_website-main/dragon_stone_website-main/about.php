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
        <meta name="description" content="Learn about Dragon Stone, our mission, and our commitment to quality products.">
        <title>DRAGON STONE -ABOUT US</title>
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
            .navbar-custom .fa-user {
                color: #ffffff;
            }
            
            .star .fas.fa-star {
                color: yellow;
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
            }
            
            .one img {
                transition: transform 0.3s ease;
            }
            
            .one:hover img {
                transform: scale(1.05);
            }
            
            .details {
                position: absolute;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                background: rgba(0, 0, 0, 0.7);
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                width: 80%;
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
            
            h5,
            h1,
            p {
                color: white;
            }
            
            h3 {
                color: white;
            }
        </style>
    </head>

    <body>
        <!-- Navbar Section -->
        <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.html">DRAGON STONE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- LEFT LINKS -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
                        <li class="nav-item"><a class="nav-link" href="products.php">PRODUCTS</a></li>
                        <li class="nav-item"><a class="nav-link active" href="about.php">ABOUT</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">CONTACT</a></li>
                        <li class="nav-item"><a class="nav-link" href="shop.php">SHOP</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- ABOUT SECTION -->
        <section id="about" class="py-5">
            <div class="container mt-5 pt-5">
                <h1 class="text-center mb-4">ABOUT DRAGON STONE</h1>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <p class="lead mb-4">
                            WELCOME <strong>DRAGON STONE</strong>,WHERE QUALITY MEETS PASSION FOUNDED IN 2001, WE ARE DEDICATED bringing you premium products that blend craftsmanship, innovation, and sustainability. Our mission is to provide exceptional
                            value while ensuring every item reflects our commitment to excellence.
                        </p>
                        <p>
                            At Dragon Stone, we believe in creating meaningful connections with our customers by offering products that are not only high-quality but also ethically sourced. From our carefully curated collections to our customer-first approach, we strive to make
                            your shopping experience seamless and enjoyable.
                        </p>
                        <p>
                            Our team is driven by a shared vision of delivering the best in the market, and we’re proud to serve a growing community of customers who trust us for their needs. Thank you for choosing Dragon Stone – we’re excited to be part of your journey!
                        </p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-4 text-center">
                        <h3>OUR MISSION</h3>
                        <p>To deliver premium, sustainable products that inspire and delight our customers.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <h3>OUR VISION</h3>
                        <p>To be the leading destination for quality-conscious shoppers worldwide.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <h3>OUR VALUES</h3>
                        <p>INTEGRITY, INNOVATION AUTHENTICITY,GET RICH AND DIE FLY.</p>
                    </div>
                </div>
            </div>
        </section>

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

                        </div>
                        <a href="contact.html" class="footer-link"><i class="fas fa-envelope"></i>CONTACT US</a>
                        <a href="shipping.html" class="footer-link"><i class="fas fa-truck"></i>SHIPPING POLICY</a>
                        <a href="returns.html" class="footer-link"><i class="fas fa-exchange-alt"></i>RETURNS & EXCHANGES</a>
                        <a href="faq.html" class="footer-link"><i class="fas fa-question-circle"></i>FAQs</a>
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
        <script>
            // Set active link based on current page
            document.addEventListener('DOMContentLoaded', function() {
                const currentPath = window.location.pathname.split('/').pop() || 'index.html';
                const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
                navLinks.forEach(link => {
                    const href = link.getAttribute('href');
                    if (href === currentPath) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });
            });
        </script>
    </body>

    </html>