<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>


<?php
$base = "http://localhost/Cms/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="<?php echo $base; ?>assets/js/script.js" defer></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Management System</title>

    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>

<body>

<header class="simple-navbar">
    <div class="nav-box">

        <div class="logo-box">
            <a href="<?php echo $base; ?>index.php">🍽 Canteen</a>
        </div>

        <nav class="nav-links">
            <a href="<?php echo $base; ?>index.php">Home</a>
            <a href="<?php echo $base; ?>menu.php">Menu</a>
            <a href="<?php echo $base; ?>about.php">About</a>
            <a href="<?php echo $base; ?>contact.php">Contact</a>
            <a href="<?php echo $base; ?>customer/profile.php">Profile</a>
            <a href="<?php echo $base; ?>login.php" class="login-btn">Login</a>
         
<?php 

$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

?>
<a href="<?php echo $base; ?>cart.php" class="cart-link">
    <img src="<?php echo $base; ?>assets/images/cart-icon.png" class="cart-svg">
   
    
<span class="cart-badge" id="cart-count"><?php echo $cartCount; ?></span>

</a>


        </nav>

    </div>
</header>

<main class="container">
