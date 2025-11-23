<?php
session_start();
include('server/configure.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        die("Product not found.");
    }
} else {
    die("No product ID specified.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['name']); ?> - Dragon Stone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#1b4d3e; color:white;">
    <div class="container mt-5">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <img src="uploaded_img/<?php echo $product['image']; ?>" class="img-fluid mb-3" alt="<?php echo htmlspecialchars($product['name']); ?>">
        <p><strong>Price:</strong> R<?php echo number_format($product['price'], 2); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
        <p><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></p>

        <form action="shop.php" method="post">
            <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $product['image']; ?>">
            <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
        </form>

        <a href="shop.php" class="btn btn-secondary mt-3">Back to Shop</a>
    </div>
</body>
</html>

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
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<div class="banner">
   <div class="start-nav">
      <h1>Products</h1>
      <p>GET RIC & STAY FLY</p>
   </div>
</div>

<?php include 'slider.php'; ?>

<div class="container">

<section class="products" >
   <div class="head-container">
      <h1 class="heading">latest products</h1>
      <h3>
         <button class="btn wishlist-btn" onclick="window.location.href='wishlist.php'">
            View Wishlist
         </button>
      </h3>
   </div>
   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category = 'Recommended'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">R<?php echo $fetch_product['price']; ?></div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="hidden" name="product_description" value="<?php echo $fetch_product['description']; ?>">
            <input type="hidden" name="product_category" value="<?php echo $fetch_product['category']; ?>">
            <button type="button" class="btn view-product" data-id="<?php echo $fetch_product['id']; ?>">View</button>
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>

<?php @include 'footer.php'; ?>

<!-- Flickity JS link -->
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script type="text/javascript">
   $('.main-carousel').flickity({
      cellAlign: 'left',
      wrapAround: true,
      freeScroll: true
   });
</script>

</body>
</html>