<?php
session_start();
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRAGON STONE - CART</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" />
    <style>
        body {
            background-image: url('assets/images/GREEN.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;c
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
        .cart-section {
            margin: 50px auto;
            padding: 30px;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            max-width: 800px;
            color: white;
        }
        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #a5c9a1;
        }
        .cart-item img {
            width: 100px;
            margin-right: 20px;
            border-radius: 5px;
        }
        .cart-item-details h4 {
            margin: 0;
            color: white;
        }
        .cart-item-details p {
            margin: 5px 0;
            color: #a5c9a1;
        }
        .cart-item-actions button {
            background-color: #a5c9a1;
            color: #1b4d3e;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .cart-total {
            text-align: right;
            margin-top: 20px;
        }
        .checkout-btn {
            background-color: #a5c9a1;
            color: #1b4d3e;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 16px;
        }
        .empty-cart {
            color: white;
            text-align: center;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">DRAGON STONE</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="products.php">PRODUCTS</a></li>
                    <li class="nav-item"><a class="nav-link" href="shop.php">SHOP</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-cart-shopping"></i>CART
                            <span class="cart-counter" id="cartCounter">0</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="cart-section container my-5 py-5">
        <h2>YOUR CART</h2>
        <hr>
        <div id="cart-items"></div>
        <div class="cart-total">
            <p>Total: R<span id="cart-total-amount">0.00</span></p>
            <button class="checkout-btn" id="checkoutBtn">PROCEED TO CHECKOUT</button>
        </div>
    </section>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function updateCartCounter() {
            const cartCounter = document.getElementById('cartCounter');
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCounter.textContent = totalItems;
        }

        function updateCartDisplay() {
            const cartItemsContainer = document.getElementById('cart-items');
            const cartTotalAmount = document.getElementById('cart-total-amount');
            const checkoutBtn = document.getElementById('checkoutBtn');
            cartItemsContainer.innerHTML = '';

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = '<p class="empty-cart">Your cart is empty.</p>';
                cartTotalAmount.textContent = '0.00';
                checkoutBtn.style.display = 'none';
                return;
            }

            let total = 0;
            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-item');
                cartItem.innerHTML = `
                    <img src="${item.image}" alt="${item.name}">
                    <div class="cart-item-details">
                        <h4>${item.name}</h4>
                        <p>Price: R${item.price.toFixed(2)}</p>
                        <p>Subtotal: R${itemTotal.toFixed(2)}</p>
                    </div>
                    <div class="cart-item-actions">
                        <button onclick="updateQuantity(${index}, ${item.quantity + 1})">+</button>
                        <button onclick="updateQuantity(${index}, ${item.quantity - 1})">-</button>
                        <button onclick="removeFromCart(${index})">Remove</button>
                    </div>
                `;
                cartItemsContainer.appendChild(cartItem);
            });

            cartTotalAmount.textContent = total.toFixed(2);
            checkoutBtn.style.display = 'block';
            updateCartCounter();
        }

        function updateQuantity(index, newQuantity) {
            if (newQuantity < 1) {
                removeFromCart(index);
                return;
            }
            cart[index].quantity = newQuantity;
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartDisplay();
        }

        function removeFromCart(index) {
            const itemKey = index;
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartDisplay();

            fetch('remove_from_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `key=${encodeURIComponent(itemKey)}`
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
            })
            .catch(error => {
                console.error('Error removing item from session:', error);
            });
        }

        document.getElementById('checkoutBtn').addEventListener('click', function() {
            if (cart.length === 0) {
                alert('Your cart is empty.');
                return;
            }
            alert('Proceeding to checkout...');
            window.location.href = 'checkout.php';
        });

        document.addEventListener('DOMContentLoaded', function() {
            updateCartDisplay();
            updateCartCounter();
        });
    </script>
</body>
</html>
