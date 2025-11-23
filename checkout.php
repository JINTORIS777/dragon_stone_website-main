<?php
session_start();
require_once 'secure_images.php';
$currentPage = basename($_SERVER['PHP_SELF']);
//include('../server/configure.php');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <script src="https://www.paypal.com/sdk/js?client-id=AXhuWBwoajbnVkvM7mD3_NoZOtsh5tsj9RM7Mlh8Zuqkz0-m75HAamH3RDaVSmduOB4XG_Twt2kZdlaf&currency=USD"></script>
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
                            <a class="nav-link" href="checkout.php">
                                <i class="fa-solid fa-cart-shopping"></i>CHECKOUT
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
                            <span>SELECT</span>
                        </div>
                        <div class="stepper-item">
                            <div class="stepper-circle active">2</div>
                            <span>CHECKOUT</span>
                        </div>
                        <div class="stepper-item">
                            <div class="stepper-circle">3</div>
                            <span>PAYMENT</span>
                        </div>
                    </div>

                    <!-- ORDER SUMMARY-->
                    <h4 class="h2">ORDER SUMMARY</h4>
                    <table class="table checkout-table mt-4" id="cart-table">
                        <thead>
                            <tr>
                                <th>PRODUCT</th>
                                <th>QUANTITY</th>
                                <th>SUBTOTAL</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="checkout-items">
                            <!-- Items will be populated by JavaScript from localStorage -->
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div id="loading-message">Loading your items...</div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="2" class="text-end cart-total"><strong>TOTAL</strong></td>
                                <td class="cart-total cart-total-amount"><strong id="checkout-total">R0.00</strong></td>
                                <td></td>
                            </tr>
                        </tfoot>
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
                                <option value="" disabled selected>SELECT PAYMENT METHOD</option>

                                <option value="paypal">PAYPAL</option>
                            </select>
                            </div>
                                                        <div class="form-check mb-3">
                                                                <input class="form-check-input" type="checkbox" value="" id="simulatePayment">
                                                                <label class="form-check-label" for="simulatePayment">Simulate payment (test only)</label>
                                                        </div>
                                                        <button id="confirmOrder" type="button" class="btn confirm-btn">Confirm Order</button>
                                                        <div id="paypal-button-container" style="display:none;"></div>

                                                        <!-- Simulated credentials modal -->
                                                        <div class="modal" tabindex="-1" id="simulateModal" style="display:none;">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Simulate Payment Credentials</h5>
                                                                        <button type="button" class="btn-close" id="simulateClose"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Test Email</label>
                                                                            <input type="email" id="testEmail" class="form-control" placeholder="buyer@example.com">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Test Token</label>
                                                                            <input type="text" id="testToken" class="form-control" placeholder="fake-token-1234">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" id="simulateCancel">Cancel</button>
                                                                        <button type="button" class="btn btn-primary" id="simulateConfirm">Confirm Payment</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                            
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
    


<script>
// Enhanced checkout functionality with localStorage integration
document.addEventListener('DOMContentLoaded', function(){
    
    // Secure image source function
    function getSecureImageSrc(imagePath) {
        // For now, we'll trust the certification system and use the provided path
        // In a production environment, this would validate against certified images
        return imagePath || 'assets/images/placeholder.jpg';
    }
    
    // Load items from localStorage and populate checkout table
    function loadCheckoutItems() {
        const cartItems = JSON.parse(localStorage.getItem('cart') || '[]');
        const tableBody = document.getElementById('checkout-items');
        const totalElement = document.getElementById('checkout-total');
        const loadingMessage = document.getElementById('loading-message');
        
        if (cartItems.length === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            No items to checkout. <a href="shop.php" class="alert-link">Continue Shopping</a>
                        </div>
                    </td>
                </tr>
            `;
            totalElement.textContent = 'R0.00';
            return;
        }
        
        let total = 0;
        let html = '';
        
        cartItems.forEach((item, index) => {
            const price = parseFloat(item.price || 0);
            const quantity = parseInt(item.quantity || 1);
            const subtotal = price * quantity;
            total += subtotal;
            
            html += `
                <tr data-index="${index}">
                    <td>
                        <div class='product-info d-flex align-items-center'>
                            <img src='${item.image || 'assets/images/placeholder.jpg'}' alt='${item.name}' class='me-3' style='width:80px;height:auto;' data-certified='true' />
                            <div>
                                <p class='mb-1 product-name fw-bold'>${item.name}</p>
                                <small class='d-block mb-1 price-per-item text-muted' data-price='${price}'>R${price.toFixed(2)} each</small>
                                <span class='badge bg-success' style='font-size:0.6rem;'><i class='fas fa-shield-check me-1'></i>Certified</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class='d-flex align-items-center justify-content-center'>
                            <button class='btn btn-sm btn-outline-secondary qty-btn me-2' data-action='decrease' ${quantity <= 1 ? 'disabled' : ''}>-</button>
                            <span class='mx-2 quantity-display fw-bold'>${quantity}</span>
                            <button class='btn btn-sm btn-outline-secondary qty-btn ms-2' data-action='increase'>+</button>
                        </div>
                    </td>
                    <td class='subtotal-cell fw-bold text-success'>R${subtotal.toFixed(2)}</td>
                    <td>
                        <button class='btn btn-danger btn-sm remove-btn'>
                            <i class='fas fa-trash'></i>
                        </button>
                    </td>
                </tr>
            `;
        });
        
        tableBody.innerHTML = html;
        totalElement.textContent = `R${total.toFixed(2)}`;
        
        // Update cart counter
        const cartCounter = document.getElementById('cartCounter');
        if (cartCounter) cartCounter.textContent = cartItems.length;
        
        // Re-attach event listeners
        attachItemEventListeners();
    }
    
    // Function to update localStorage cart
    function updateLocalStorageCart() {
        const cartItems = JSON.parse(localStorage.getItem('cart') || '[]');
        localStorage.setItem('cart', JSON.stringify(cartItems));
        loadCheckoutItems(); // Reload the display
    }
    
    // Function to attach event listeners to quantity and remove buttons
    function attachItemEventListeners() {
        // Quantity buttons
        document.querySelectorAll('.qty-btn').forEach(btn => {
            btn.addEventListener('click', function(){
                const row = btn.closest('tr');
                const index = parseInt(row.getAttribute('data-index'));
                const action = btn.getAttribute('data-action');
                const cartItems = JSON.parse(localStorage.getItem('cart') || '[]');
                
                if (cartItems[index]) {
                    let quantity = parseInt(cartItems[index].quantity || 1);
                    
                    if (action === 'increase') {
                        quantity++;
                    } else if (action === 'decrease' && quantity > 1) {
                        quantity--;
                    }
                    
                    cartItems[index].quantity = quantity;
                    localStorage.setItem('cart', JSON.stringify(cartItems));
                    loadCheckoutItems();
                    
                    showNotification('Quantity updated', 'success');
                }
            });
        });
        
        // Remove buttons
        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', function(){
                const row = btn.closest('tr');
                const index = parseInt(row.getAttribute('data-index'));
                const cartItems = JSON.parse(localStorage.getItem('cart') || '[]');
                const productName = cartItems[index]?.name || 'Item';
                
                if (confirm(`Remove "${productName}" from checkout?`)) {
                    cartItems.splice(index, 1);
                    localStorage.setItem('cart', JSON.stringify(cartItems));
                    loadCheckoutItems();
                    showNotification('Item removed', 'success');
                }
            });
        });
    }
    
    // Simple notification function
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'error' ? 'danger' : 'success'} position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 1050; min-width: 300px;';
        notification.innerHTML = `<i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle me-2"></i>${message}`;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
    
    // Load items on page load
    loadCheckoutItems();

    // PayPal button rendering after Confirm Order
    const confirmBtn = document.getElementById('confirmOrder');
    const paypalContainer = document.getElementById('paypal-button-container');
    let paypalRendered = false;
    confirmBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Check if there are items to checkout
        const cartItems = JSON.parse(localStorage.getItem('cart') || '[]');
        if (cartItems.length === 0) {
            showNotification('No items to checkout. Please add items first.', 'error');
            return;
        }
        
        const simulate = document.getElementById('simulatePayment').checked;
        if (simulate) {
            // show modal to enter fake credentials
            document.getElementById('simulateModal').style.display = 'block';
            return;
        }
        confirmBtn.style.display = 'none';
        paypalContainer.style.display = 'block';
        if (!paypalRendered) {
            paypalRendered = true;
            paypal.Buttons({
                createOrder: function(data, actions) {
                    const totalElement = document.getElementById('checkout-total');
                    let total = 1; // Default fallback
                    if (totalElement) {
                        const match = totalElement.textContent.match(/R(\d+(?:\.\d+)?)/);
                        if (match) total = match[1];
                    }
                    return actions.order.create({
                        purchase_units: [{
                            amount: { value: total, currency_code: 'USD' }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        // Clear the cart after successful payment
                        localStorage.removeItem('cart');
                        window.location.href = 'success.php';
                    });
                },
                onCancel: function(data) {
                    window.location.href = 'cancel.php';
                },
                onError: function(err) {
                    showNotification('PayPal error: ' + err, 'error');
                }
            }).render('#paypal-button-container');
        }
    });

    // Simulate modal handlers
    const simulateModal = document.getElementById('simulateModal');
    const simulateClose = document.getElementById('simulateClose');
    const simulateCancel = document.getElementById('simulateCancel');
    const simulateConfirm = document.getElementById('simulateConfirm');
    function closeSimModal(){ simulateModal.style.display='none'; }
    simulateClose.addEventListener('click', closeSimModal);
    simulateCancel.addEventListener('click', closeSimModal);
    simulateConfirm.addEventListener('click', function(){
        const email = document.getElementById('testEmail').value.trim();
        const token = document.getElementById('testToken').value.trim();
        if(!email || !token){ 
            showNotification('Please provide test email and token.', 'error'); 
            return; 
        }
        
        // Clear the cart after successful payment simulation
        localStorage.removeItem('cart');
        showNotification('Order confirmed successfully!', 'success');
        
        // Redirect to success page
        setTimeout(() => {
            window.location.href = 'success.php';
        }, 2000);
    });
});
</script>

</body>

    </html>