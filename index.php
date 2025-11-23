<?php
session_start();

// Database connection - wrap in error handling
$conn = null;
if(file_exists('server/config.php')){
    @include 'server/config.php';
    // Only connect if trying to use database
}

// Define random_num function
function random_num($length){
    $result = '';
    $chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charLength = strlen($chars);
    for($i = 0; $i < $length; $i++){
        $result .= $chars[rand(0, $charLength - 1)];
    }
    return $result;
}

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password)){
        if($conn){
            $query = "SELECT * FROM `users` WHERE `user_name` = '$user_name' limit 1";
            $result = mysqli_query($conn, $query);
            if($result){
                if($result && mysqli_num_rows($result) > 0){
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['password'] === $password){
                        $_SESSION['user_id'] = $user_data['id'];
                        echo "<script> location.href='home.php'; </script>";
                        die;
                    }
                }
            }
            echo "Wrong information added!";
        } else {
            echo "Database connection error. Please try again.";
        }
    }else{
        echo "All fields are required";
    }
}
?>
<?php
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $user_id = random_num(5);

    if(!empty($user_name) && !empty($email) && !empty($phone_number) && !empty($password)){
        if($conn){
            $query = "INSERT INTO `users` (`id`, `user_name`, `email`, `phone_number`, `password`) values ('$user_id', '$user_name', '$email', '$phone_number', '$password')";
            mysqli_query($conn, $query);
            echo "<script> location.href='login.php'; </script>";
            echo "Signup Successful";
            die;
        } else {
            echo "Database connection error. Please try again.";
        }
    }else{
        echo "All fields are required";
    }
}

?>

<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Shop premium products at Dragon Stone with the best prices in the market.">
        <title>DRAGON STONE</title>
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
            }
            
            .one:hover {
                transform: translateY(-10px);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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
            
            section#home p {
                font-size: 30px;
            }
            /* Smooth scroll behavior */
            
            html {
                scroll-behavior: smooth;
            }
            /* Toast notification */
            
            .toast-container {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1050;
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
                    <!-- LEFTS LINKS -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="#home">HOME</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">ABOUT</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">CONTACT</a></li>
                        <li class="nav-item"><a class="nav-link" href="shop.php">SHOP</a></li>
                    </ul>

                    <!-- RIGHT LINKS -->
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

        <!-- Toast Container -->
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

        <!-- LOGIN MODAL -->
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

        <!-- HOME SECTION -->
        <section id="home" class="mt-5 pt-5 text-center">
            <div class="container">
                <h5>NEW ARRIVALS</h5>
                <h1>BEST PRICES THIS SEASON</h1>
                <p>DRAGON STONE OFFERS THE BEST PRODUCTS FOR YOU AT THE BEST PRICES</p>
                <a href="shop.php" class="btn btn-dark">Shop NOW</a>
                <button class="btn btn-outline-dark">LIST PRODUCTS</button>
            </div>
        </section>

        <!-- FEATURED SECTION -->
        <section id="featured" class="my-5 pb-5">
            <div class="container text-center mt-5 py-5">
                <h3>OUR FEATURED</h3>
                <hr class="mx-auto">
                <p>HERE YOU CAN CHECK OUT OUR FEATURED PRODUCTS</p>
                <div class="row mx-auto container-fluid">
                    <!-- ONE -->
                    <div class="one col-lg-4 col-sm-12 p-0">
                        <img class="img-fluid" style="max-width:80;" src="assets/images/GUCCI.JPG" alt="Gucci Glasses" />
                        <div class="details text-center">
                            <h2>GLASSES</h2>
                            <div class="rating" data-rating="4">
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                            </div>
                           <a href="single.product.php?product=Gucci+Glasses" class="btn btn-dark text-uppercase">BUY NOW</a>

                        </div>
                    </div>

                    <!-- TWO -->
                    <div class="one col-lg-4 col-sm-12 p-0">
                        <img class="img-fluid" style="max-width:80;" src="assets/images/GOTH GUITER.JPG" alt="Goth Guitar" />
                        <div class="details text-center">
                            <h2>GUITARS</h2>
                            <div class="rating" data-rating="3">
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                            </div>
                            <button class="btn btn-dark text-uppercase" data-product="Goth Guitar" data-price="299.99">BUY NOW</button>
                        </div>
                    </div>

                    <!-- THREE -->
                    <div class="one col-lg-4 col-sm-12 p-0">
                        <img class="img-fluid" style="max-width:80;" src="assets/images/POLA-ROID.jpeg" alt="Polaroid Camera" />
                        <div class="details text-center">
                            <h2>CAMERAS</h2>
                            <div class="rating" data-rating="5">
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                            </div>
                            <button class="btn btn-dark text-uppercase" data-product="Polaroid Camera" data-price="149.99">BUY NOW</button>
                        </div>
                    </div>

                    <!-- FOUR -->
                    <div class="one col-lg-4 col-sm-12 p-0 offset-lg-4">
                        <img class="img-fluid" style="max-width:80;" src="assets/images/TOYS.JPEG" alt="Toys Collection" />
                        <div class="details text-center">
                            <h2>TOYS</h2>
                            <div class="rating" data-rating="4">
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                            </div>
                            <button class="btn btn-dark text-uppercase" data-product="Toys Collection" data-price="49.99">BUY NOW</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- WATCHES SECTION -->
        <section id="watches-sale" class="mt-5 pt-5 text-center">
            <div class="container">
                <p>WATCHES MID SEASON SALES</p>
                <a href="shop.php" class="btn btn-dark">SHOP NOW</a>
                <div class="row">
                    <!-- ONE -->
                    <div class="one col-lg-4 col-sm-12 p-0">
                        <img class="img-fluid" style="max-width:80;" src="assets/images/PATTEK PHILIP.JPG" alt="Patek Philippe Watch" />
                        <div class="details text-center">
                            <h2>WATCHES</h2>
                            <div class="rating" data-rating="5">
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                            </div>
                            <button class="btn btn-dark text-uppercase" data-product="PATEK PHILLIPE WATCHES" data-price="499.99">BUY NOW</button>
                        </div>
                    </div>

                    <!-- TWO -->
                    <div class="one col-lg-4 col-sm-12 p-0">
                        <img class="img-fluid" style="max-width:80;" src="assets/images/FROST.JPG" alt="Frost Watch" />
                        <div class="details text-center">
                            <h2>FROST WATCHES</h2>
                            <div class="rating" data-rating="4">
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                            </div>
                            <button class="btn btn-dark text-uppercase" data-product="Frost Watch" data-price="399.99">BUY NOW</button>
                        </div>
                    </div>

                    <!-- THREE -->
                    <div class="one col-lg-4 col-sm-12 p-0">
                        <img class="img-fluid" style="max-width:80;" src="assets/images/PATTEK ICE.JPEG" alt="Patek Ice Watch" />
                        <div class="details text-center">
                            <h2>PATTEK ICE WATCHES</h2>
                            <div class="rating" data-rating="3">
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                            </div>
                            <button class="btn btn-dark text-uppercase" data-product="Patek Ice Watch" data-price="449.99">BUY NOW</button>
                        </div>
                    </div>

                    <!-- FOUR -->
                    <div class="one col-lg-4 col-sm-12 p-0">
                        <img class="img-fluid" style="max-width:80;" src="assets/images/ROLLIEEE.JPEG" alt="Rolex Watch" />
                        <div class="details text-center">
                            <h2>WATCHES</h2>
                            <div class="rating" data-rating="5">
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                                <span class="star"><i class="fas fa-star"></i></span>
                            </div>
                            <button class="btn btn-dark text-uppercase" data-product="Rolex Watch" data-price="599.99">BUY NOW</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- AUTUMN SECTION -->
        <section id="autumn-collection" class="mt-5 pt-5 text-center">
            <div class="container">
                <h5>AUTUMN COLLECTION UP TO 30% OFF</h5>
                <p>MID SEASON SALES</p>
                <a href="shop.php" class="btn btn-dark">SHOP NOW</a>
            </div>
        </section>

        <!-- AUTUMN FEATURED SECTION -->
      <section class="products">
    <div class="row">
        <!-- ONE -->
        <div class="one col-lg-4 col-sm-12 p-0">
            <img class="img-fluid" src="assets/images/BAPESTAS.JPG" alt="Bapestas Sneakers" />
            <div class="details text-center">
                <h2>BAPESTAS</h2>
                <div class="rating" data-rating="4">
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                </div>
                <button class="btn btn-dark text-uppercase" data-product="Bapestas Sneakers" data-price="249.99">BUY NOW</button>
            </div>
        </div>

        <!-- TWO -->
        <div class="one col-lg-4 col-sm-12 p-0">
            <img class="img-fluid" src="assets/images/DESIGNER JACKET.JPG" alt="Designer Jacket" />
            <div class="details text-center">
                <h2>DESIGNER JACKETS</h2>
                <div class="rating" data-rating="5">
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                </div>
                <button class="btn btn-dark text-uppercase" data-product="Designer Jacket" data-price="199.99">BUY NOW</button>
            </div>
        </div>

        <!-- THREE -->
        <div class="one col-lg-4 col-sm-12 p-0">
            <img class="img-fluid" src="assets/images/GREEN JACKET.JPEG" alt="Green Jacket" />
            <div class="details text-center">
                <h2>GREEN JACKETS</h2>
                <div class="rating" data-rating="4">
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                </div>
                <button class="btn btn-dark text-uppercase" data-product="Green Jacket" data-price="179.99">BUY NOW</button>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- FOUR -->
        <div class="one col-lg-4 col-sm-12 p-0">
            <img class="img-fluid" src="assets/images/NEON BAPESTAS.JPG" alt="NEON BAPESTAS SNEAKERS" />
            <div class="details text-center">
                <h2>NEON BAPESTAS</h2>
                <div class="rating" data-rating="3">
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                </div>
                <button class="btn btn-dark text-uppercase" data-product="NEON BAPETSA SNEAKERS" data-price="269.99">BUY NOW</button>
            </div>
        </div>

        <!-- FIVE -->
        <div class="one col-lg-4 col-sm-12 p-0">
            <img class="img-fluid" src="assets/images/GOTH GUITER.JPG" alt="Goth Guitar" />
            <div class="details text-center">
                <h2>GUITARS</h2>
                <div class="rating" data-rating="3">
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                    <span class="star"><i class="fas fa-star"></i></span>
                </div>
                <button class="btn btn-dark text-uppercase" data-product="Goth Guitar" data-price="299.99">BUY NOW</button>
            </div>
        </div>
    </div>
</section>


        <!-- SUBSCRIPTION SECTION ---->
        <section id="subscription" class="my-5 py-5 bg-light text-center">
            <div class="container">
                <h3 class="fw-bold">JOIN MEMBERSHIP</h3>
                <p>SUBSCRIBE TO DRAGON STONE PREMIUM AND UNLOCK EXCLUSIVE DEALS FREE SHIPPING</p>
                <div class="row justify-content-center">
                    <!-- BASIC PLAN  -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card shadow-lg border-0">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">BASIC</h5>
                                <p class="card-text">$9.99 / MONTH</p>
                                <ul class="list-unstyled">
                                    <li>✔ FREE SHIPPING</li>
                                    <li>✔ EARLY ACCESS TO SALES</li>
                                    <li>✘ VIP PRODUCTS</li>
                                </ul>
                                <button class="btn btn-dark">SUBSCRIBE</button>
                            </div>
                        </div>
                    </div>

                    <!-- STANDARD PLAN -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card shadow-lg border-0">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">STANDARD</h5>
                                <p class="card-text">$19.99 / MONTH</p>
                                <ul class="list-unstyled">
                                    <li>✔ FREE SHIPPING</li>
                                    <li>✔ EARLY ACCESS</li>
                                    <li>✔ VIP PRODUCTS</li>
                                </ul>
                                <button class="btn btn-dark">SUBSCRIBE</button>
                            </div>
                        </div>
                    </div>

                    <!-- PREMIUM PLAN -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card shadow-lg border-0">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">PREMIUM</h5>
                                <p class="card-text">$29.99 / MONTH</p>
                                <ul class="list-unstyled">
                                    <li>✔ FREE SHIPPING</li>
                                    <li>✔ EARLY ACCESS TO SALES</li>
                                    <li>✔ VIP PRODUCTS</li>
                                    <li>✔ EXCLUSIVE DEALS</li>
                                </ul>
                                <button class="btn btn-dark">SUBSCRIBE</button>
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
                            <a href="shipping.php" class="footer-link"><i class="fas fa-truck"></i>SHIPPING POLICY</a>
                            <a href="returns.php" class="footer-link"><i class="fas fa-exchange-alt"></i>RETURNS & EXCHANGES</a>
                            <a href="faq.php" class="footer-link"><i class="fas fa-question-circle"></i>FAQs</a>
                            <a href="contact.php" class="footer-link"><i class="fas fa-envelope"></i> CONTACT US</a>
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
                const currentPath = window.location.pathname.split('/').pop() || 'index.php';
                const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
                navLinks.forEach(link => {
                    const href = link.getAttribute('href');
                    if (href === currentPath || (href.startsWith('#') && href.slice(1) === window.location.hash.slice(1))) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });

                // Dynamic star ratings
                document.querySelectorAll('.rating').forEach(rating => {
                    const stars = rating.querySelectorAll('.star');
                    const ratingValue = parseInt(rating.getAttribute('data-rating'));
                    stars.forEach((star, index) => {
                        star.classList.add(index < ratingValue ? 'filled' : 'empty');
                    });
                });

                // ADD TO CART FUNCTIONALITY 
                document.querySelectorAll('.btn-dark.text-uppercase').forEach(button => {
                    if (button.getAttribute('data-product')) {
                        button.addEventListener('click', () => {
                            const product = button.getAttribute('data-product');
                            const price = parseFloat(button.getAttribute('data-price'));
                            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                            cart.push({
                                name: product,
                                price: price
                            });
                            localStorage.setItem('cart', JSON.stringify(cart));
                            document.querySelector('#cartCounter').textContent = cart.length;

                            // Show toast notification
                            const toast = new bootstrap.Toast(document.querySelector('#cartToast'));
                            document.querySelector('#cartToast .toast-body').textContent = `${product} added to cart!`;
                            toast.show();

                            // Navigate to shop.php
                            window.location.href = 'shop.php';
                        });
                    }
                });

                // POPULATE CART MODEL
                document.querySelector('#cartModal').addEventListener('show.bs.modal', function() {
                    const cartItems = JSON.parse(localStorage.getItem('cart') || '[]');
                    document.querySelector('#cartModal .modal-body').innerHTML = cartItems.length ?
                        cartItems.map(item => `<p>${item.name} - $${item.price.toFixed(2)}</p>`).join('') :
                        '<p>Your cart is empty.</p>';
                    document.querySelector('#cartCounter').textContent = cartItems.length;
                });
            });

            // HANDLE LOGIN
            function handleLogin() {
                const username = document.querySelector('#username').value;
                const password = document.querySelector('#password').value;
                console.log('Login attempt:', {
                    username,
                    password
                });
                bootstrap.Modal.getInstance(document.querySelector('#loginModal')).hide();
            }

            // HANDLE NEWS LETTER SUBSCRIPTION
            function handleNewsletter() {
                const email = document.querySelector('.newsletter-input').value;
                console.log('Newsletter subscription:', {
                    email
                });
                document.querySelector('.newsletter-input').value = '';
                const toast = new bootstrap.Toast(document.querySelector('#cartToast'));
                document.querySelector('#cartToast .toast-body').textContent = 'Subscribed to newsletter!';
                toast.show();
            }
        </script>
    </body>

    </html>