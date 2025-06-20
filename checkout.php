<?php
include 'components/connection.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
    exit;
}

if (isset($_POST['place_order'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $flat = filter_var($_POST['flat'], FILTER_SANITIZE_STRING);
    $street = filter_var($_POST['street'], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
    $country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
    $pincode = filter_var($_POST['pincode'], FILTER_SANITIZE_STRING);
    $address_type = filter_var($_POST['address_type'], FILTER_SANITIZE_STRING);
    $method = filter_var($_POST['method'], FILTER_SANITIZE_STRING);

    $address = "$flat, $street, $city, $country, $pincode";

    $verify_cart = $conn->prepare("SELECT * FROM cartt WHERE user_id = ?");
    $verify_cart->execute([$user_id]);

    // Single Product Checkout
    if (isset($_GET['get_id'])) {
        $get_product = $conn->prepare("SELECT * FROM product WHERE id = ? LIMIT 1");
        $get_product->execute([$_GET['get_id']]);
        if ($get_product->rowCount() > 0) {
            $product = $get_product->fetch(PDO::FETCH_ASSOC);
            $insert_order = $conn->prepare("INSERT INTO ordered 
                (id, user_id, name, number, email, address, address_type, method, product_id, price, qty) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_order->execute([
                unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method,
                $product['id'], $product['price'], 1
            ]);
            header('location:order.php');
            exit;
        } else {
            $warning_msg[] = 'Something went wrong!';
        }
    }

    // Cart Checkout
    elseif ($verify_cart->rowCount() > 0) {
        while ($cart = $verify_cart->fetch(PDO::FETCH_ASSOC)) {
            $product_id = $cart['product_id'];
            $product = $conn->prepare("SELECT * FROM product WHERE id = ? LIMIT 1");
            $product->execute([$product_id]);
            if ($product->rowCount() > 0) {
                $product_data = $product->fetch(PDO::FETCH_ASSOC);
                $insert_order = $conn->prepare("INSERT INTO ordered 
                    (id, user_id, name, number, email, address, address_type, method, product_id, price, qty) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_order->execute([
                    unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method,
                    $product_data['id'], $product_data['price'], $cart['qty']
                ]);
            }
        }

        // After all insertions, delete cart
        $delete_cart = $conn->prepare("DELETE FROM cartt WHERE user_id = ?");
        $delete_cart->execute([$user_id]);
        header('location:order.php');
        exit;
    } else {
        $warning_msg[] = 'Your cart is empty!';
    }
}
?>

<style type="text/css">
    <?php include 'coder.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="coder.css" type="text/css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Green Coffee - Checkout Page</title>
</head>
<body>
<?php include 'components/home.php'; ?>

<div class="main">
    <div class="banner">
        <h1>Checkout Summary</h1>
    </div>
    <div class="title2">
        <a href="head.php">Home</a><span> / Checkout Summary</span>
    </div>

    <section class="checkout">
        <div class="title">
            <img src="components/img/download.png" class="logo">    
            <h1>Checkout Summary</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatibus.</p>
        </div>
        <div class="row">
            <form method="post">
                <h3>Billing Details</h3>
                <div class="flex">
                    <div class="box">
                        <div class="input-field">
                            <p>Your Name <span>*</span></p>
                            <input type="text" name="name" required maxlength="50" placeholder="Enter your name" class="input">
                        </div>
                        <div class="input-field">
                            <p>Your Number <span>*</span></p>
                            <input type="number" name="number" required maxlength="10" placeholder="Enter your number" class="input">
                        </div>
                        <div class="input-field">
                            <p>Your Email <span>*</span></p>
                            <input type="email" name="email" required maxlength="50" placeholder="Enter your email" class="input">
                        </div>
                        <div class="input-field">
                            <p>Payment Method <span>*</span></p>
                            <select name="method" class="input">
                                <option value="cash on delivery">Cash on Delivery</option>
                                <option value="credit or debit card">Credit or Debit Card</option>
                                <option value="net banking">Net Banking</option>
                                <option value="upi or RUPAY">UPI or RUPAY</option>
                                <option value="paytm">Paytm</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <p>Address Type <span>*</span></p>
                            <select name="address_type" class="input">
                                <option value="home">Home</option>
                                <option value="office">Office</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="box">
                        <div class="input-field">
                            <p>Address Line 1 <span>*</span></p>
                            <input type="text" name="flat" required maxlength="50" placeholder="Enter your flat & building number" class="input">
                        </div>
                        <div class="input-field">
                            <p>Address Line 2 <span>*</span></p>
                            <input type="text" name="street" required maxlength="50" placeholder="Enter your street name" class="input">
                        </div>
                        <div class="input-field">
                            <p>City Name <span>*</span></p>
                            <input type="text" name="city" required maxlength="50" placeholder="Enter your city name" class="input">
                        </div>
                        <div class="input-field">
                            <p>Country Name <span>*</span></p>
                            <input type="text" name="country" required maxlength="50" placeholder="Enter your country name" class="input">
                        </div>
                        <div class="input-field">
                            <p>Pincode <span>*</span></p>
                            <input type="text" name="pincode" required maxlength="6" placeholder="847235" class="input">
                        </div>
                    </div>
                </div>
                <button type="submit" name="place_order" class="btn">Place Order</button>
            </form>

            <div class="summary">
                <h3>My Bag</h3>
                <div class="box-container">
                <?php
                    $grand_total = 0;
                    if (isset($_GET['get_id'])) {
                        $select_get = $conn->prepare("SELECT * FROM product WHERE id = ?");
                        $select_get->execute([$_GET['get_id']]);
                        while ($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)) {
                            $sub_total = $fetch_get['price'];
                            $grand_total += $sub_total;
                ?>
                    <div class="flex">
                        <img src="images/<?= $fetch_get['image']; ?>" class="image">
                        <div>
                            <h3 class="name"><?= $fetch_get['name']; ?></h3>
                            <p class="price">₹<?= $fetch_get['price']; ?>/-</p>
                        </div>
                    </div>
                <?php
                        }
                    } else {
                        $select_cart = $conn->prepare("SELECT * FROM cartt WHERE user_id = ?");
                        $select_cart->execute([$user_id]);
                        if ($select_cart->rowCount() > 0) {
                            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                                $select_product = $conn->prepare("SELECT * FROM product WHERE id = ?");
                                $select_product->execute([$fetch_cart['product_id']]);
                                $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC);

                                if ($fetch_product) {
                                    $sub_total = $fetch_cart['qty'] * $fetch_cart['price'];
                                    $grand_total += $sub_total;
                ?>
                    <div class="flex">
                        <img src="images/<?= $fetch_product['image']; ?>">
                        <div>
                            <h3 class="name"><?= $fetch_product['name']; ?></h3>
                            <p class="price">₹<?= $fetch_product['price']; ?> x <?= $fetch_cart['qty']; ?></p>
                        </div>
                    </div>
                <?php
                                }
                            }
                        } else {
                            echo '<p class="empty">Your cart is empty</p>';
                        }
                    }
                ?>
                </div>
                <div class="grand-total"><span>Total Amount Payable:</span> ₹<?= $grand_total ?>/-</div>
            </div>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="code.js" defer></script>
<?php include 'components/alert.php'; ?>
</body>
</html>