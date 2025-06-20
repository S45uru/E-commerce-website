<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="coder.css" type="text/css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>
<body>

<header class="header">
    <div class="flex">
        <a href="home.php" class="logo"><img src="components/img/logo.jpg" alt="Logo"></a>

        <nav class="navbar">
            <a href="head.php">Home</a>
            <a href="view_products.php">Products</a>
            <a href="order.php">Orders</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact Us</a>
        </nav>

        <div class="icons">
            <i class="bx bxs-user" id="user-btn"></i>

            <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM wishlists WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_items = $count_wishlist_items->rowCount();
            ?>
            <a href="wishlist.php" class="cart-btn">
                <i class="bx bx-heart"></i><sup><?= $total_wishlist_items ?></sup>
            </a>

            <?php
            $count_cart_items = $conn->prepare("SELECT * FROM cartt WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
            ?>
            <a href="cart.php" class="cart-btn">
                <i class="bx bx-cart-download"></i><sup><?= $total_cart_items ?></sup>
            </a>

            <i class="bx bx-list-plus" id="menu-btn" style="font-size: 2rem;"></i>
        </div>

        <div class="user-box">
            <p>Username: <span><?= $_SESSION['user_name']; ?></span></p>
            <p>Email: <span><?= $_SESSION['user_email']; ?></span></p>
            <a href="login.php" class="btn">Login</a>
            <a href="register.php" class="btn">Register</a>
            <form method="post">
                <button type="submit" name="logout" class="logout-btn">Log Out</button>
            </form>
        </div>
    </div>
</header>

<script src="code.js"></script>
</body>
</html>