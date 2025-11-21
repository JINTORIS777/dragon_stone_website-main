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
        <meta name="description" content="Complete your purchase at Dragon Stone with secure checkout.">
        <title>DRAGON STONE - CHECKOUT</title>
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
            
            .h2 {
                color: white;
                text-align: center;
                margin-bottom: 30px;
            }
            
            .checkout-container {
                background: rgba(255, 255, 255, 0.9);
                border-radius: 10px;
                padding: 30px;
                margin: 0 auto;
                max-width: 800px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            
            .stepper {
                display: flex;
                justify-content: center;
                margin-bottom: 30px;
            }
            
            .stepper-item {
                display: flex;
                align-items: center;
                flex-direction: column;
                margin: 0 20px;
                text-align: center;
            }
            
            .stepper-circle {
                width: 40px;
                height: 40px;
                background-color: #a5c9a1;
                color: #1b4d3e;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                margin-bottom: 10px;
            }
            
            .stepper-circle.active {
                background-color: #1b4d3e;
                color: white;
            }
            
            .stepper-item span {
                font-size: 14px;
                color: #1b4d3e;
            }
            
            .checkout-table {
                background: transparent;
                border: none;
            }
            
            .checkout-table th,
            .checkout-table td {
                padding: 10px;
                vertical-align: middle;
                border: none;
            }
            
            .product-info img {
                width: 100px;
                height: auto;
            }
            
            .form-card {
                background: white;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            
            .form-label {
                color: #1b4d3e;
                font-weight: 500;
            }
            
            .confirm-btn {
                background-color: #a5c9a1;
                color: #1b4d3e;
                border: none;
                border-radius: 5px;
                padding: 12px 30px;
                font-weight: 500;
                transition: background-color 0.3s ease;
                width: 100%;
            }
            
            .confirm-btn:hover {
                background-color: #8ab87d;
            }
            
            .cart-total {
                font-weight: bold;
                font-size: 18px;
                color: #1b4d3e;
            }
        </style>
    </head>

    <body>
        <!-- NAVBAR SECTION -->
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
                        <li class="nav-item"><a class="nav-link" href="about.php">ABOUT</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">CONTACT</a></li>
                        <li class="nav-item"><a class="nav-link" href="shop.php">SHOP</a></li>
                    </ul>
                    <!-- RIGHT LINKS -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">
                                <i class="fa-solid fa-cart-shopping"></i>CART
                                <span class="cart-counter" id="cartCounter">0</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                <i class="fa-regular fa-user"></i>LOGIN
                            </a>
                        </li>
                        <li class="nav-item">
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- CHECKOUT SECTION -->
        <section class="checkout container my-5 py-5">
            <div class="container mt-5">
                <h2 class="font-weight-bold h2">CHECKOUT</h2>
                <div class="checkout-container">
                    <!-- STEPPER-->
                    <div class="stepper">
                        <div class="stepper-item">
                            <div class="stepper-circle">1</div>
                            <span>CART</span>
                        </div>
                        <div class="stepper-item">
                            <div class="stepper-circle active">2</div>
                            <span>ChECKOUT</span>
                        </div>
                        <div class="stepper-item">
                            <div class="stepper-circle">3</div>
                            <span>CONFIRMATION</span>
                        </div>
                    </div>

                    <!-- ORDER SUMMARY-->
                    <h4 class="h2">ORDER SUMMARY</h4>
                    <table class="table checkout-table mt-4">
                        <thead>
                            <tr>
                                <th>PRODUCT</th>
                                <th>QUANTITY</th>
                                <th>SUBTOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="product-info d-flex align-items-center">
                                        <img src="assets/images/BAPESTAS.JPG" alt="BAPESTAS" class="me-3" />
                                        <div>
                                            <p class="mb-1">BAPESTAS</p>
                                            <small class="d-block mb-1"><span></span>R3000</small>
                                        </div>
                                    </div>
                                </td>
                                <td>1</td>
                                <td><span></span>R3000</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="product-info d-flex align-items-center">
                                        <img src="assets/images/BAPESTAS.JPG" alt="BAPESTAS" class="me-3" />
                                        <div>
                                            <p class="mb-1">BAPESTAS</p>
                                            <small class="d-block mb-1"><span>R</span>R3000</small>
                                        </div>
                                    </div>
                                </td>
                                <td>1</td>
                                <td><span></span>R3000</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="product-info d-flex align-items-center">
                                        <img src="assets/images/BAPESTAS.JPG" alt="BAPESTAS" class="me-3" />
                                        <div>
                                            <p class="mb-1">BAPESTAS</p>
                                            <small class="d-block mb-1"><span></span>R3000</small>
                                        </div>
                                    </div>
                                </td>
                                <td>1</td>
                                <td><span></span>R3000</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-end cart-total">TOTAL</td>
                                <td class="cart-total">R9000</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- PAYMENT & SHIPPING METHOD -->
                    <h4 class="h2 mt-5">SHIPPING & PAYMENT</h4>
                    <div class="form-card">
                        <form>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">FULL NAME </label>
                                <input type="text" class="form-control" id="fullName" placeholder="Enter your full name" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">SHIPPING ADDRESS</label>
                                <input type="text" class="form-control" id="address" placeholder="Enter your address" required>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" id="paymentMethod" required>
                                <option value="creditCard">CREDIT CARD</option>
                                <option value="paypal">PAYPAL</option>
                            </select>
                            </div>
                            <button type="submit" class="btn confirm-btn">CONFIRM ORDER</button>
                        </form>
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
    
<!-- Payment buttons inserted by integration script -->
<div id="payment-options">
  <h3>Choose payment method</h3>
  <label>Amount (ZAR): <input id="pay-amount" type="number" min="1" value="100"></label><br><br>
  <button id="paypal-btn">Pay with PayPal</button>
  <button id="stripe-btn">Pay with Debit/Credit (Stripe)</button>
</div>

<script>
async function payWithPayPal(amount){
  try{
    const res = await fetch('/server/payments/paypal_create_order.php', {
      method: 'POST',
      headers: {'Content-Type':'application/json'},
      body: JSON.stringify({amount: amount})
    });
    const data = await res.json();
    if (data.approve_link) {
      window.location = data.approve_link;
    } else {
      alert('PayPal error: '+ JSON.stringify(data));
    }
  }catch(e){
    alert('Error starting PayPal: '+e);
  }
}

async function payWithStripe(amount){
  try{
    const res = await fetch('/server/payments/stripe_create_session.php', {
      method: 'POST',
      headers: {'Content-Type':'application/json'},
      body: JSON.stringify({amount: amount})
    });
    const data = await res.json();
    if (data.url) {
      window.location = data.url;
    } else {
      alert('Stripe error: '+ JSON.stringify(data));
    }
  }catch(e){
    alert('Error starting Stripe: '+e);
  }
}

document.addEventListener('DOMContentLoaded', function(){
  const payBtn = document.getElementById('paypal-btn');
  const stripeBtn = document.getElementById('stripe-btn');
  const amountInput = document.getElementById('pay-amount');
  payBtn.addEventListener('click', ()=> payWithPayPal(amountInput.value));
  stripeBtn.addEventListener('click', ()=> payWithStripe(amountInput.value));
});
</script>

</body>

    </html>