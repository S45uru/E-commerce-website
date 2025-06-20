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

if (isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    header("location:order.php");
    exit;
}

// ✅ Cancel Order Handler
if (isset($_POST['cancel']) && !empty($get_id)) {
    $update_ordered = $conn->prepare("UPDATE ordered SET status = ? WHERE id = ?");
    $update_ordered->execute(['canceled', $get_id]);
    header("Location: order.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Coffee - Order Detail Page</title>
    <link rel="stylesheet" href="coder.css" type="text/css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php include 'components/home.php'; ?>

<div class="main">
    <div class="banner">
        <h1>Order Detail</h1>
    </div>
    <div class="title2">
        <a href="head.php">Home</a><span> / Order Detail</span>
    </div>

    <section class="order-detail">
        <div class="box-container">
            <div class="title">
                <img src="components/img/download.png" class="logo">
                <h1>Order Detail</h1>
                <p>Check the details of your placed order here.</p>
            </div>

            <?php
            $grand_total = 0;
            $select_ordered = $conn->prepare("SELECT * FROM ordered WHERE id = ? LIMIT 1");
            $select_ordered->execute([$get_id]);

            if ($select_ordered->rowCount() > 0) {
                $fetch_ordered = $select_ordered->fetch(PDO::FETCH_ASSOC);

                $select_product = $conn->prepare("SELECT * FROM product WHERE id = ? LIMIT 1");
                $select_product->execute([$fetch_ordered['product_id']]);

                if ($select_product->rowCount() > 0) {
                    $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC);
                    $sub_total = $fetch_ordered['price'] * $fetch_ordered['qty'];
                    $grand_total += $sub_total;
            ?>

            <div class="box">
                <div class="col">
                    <p class="title"><i class="bi bi-calendar-fill"></i> <?= htmlspecialchars($fetch_ordered['date']); ?></p>
                    <img src="images/<?= htmlspecialchars($fetch_product['image']); ?>" class="image">
                    <p class="price">$<?= htmlspecialchars($fetch_ordered['price']); ?> x <?= htmlspecialchars($fetch_ordered['qty']); ?></p>
                    <h3 class="name"><?= htmlspecialchars($fetch_product['name']); ?></h3>
                    <p class="grand-total">Total amount payable: <span>$<?= htmlspecialchars($grand_total); ?></span></p>
                </div>

                <div class="col">
                    <p class="title">Billing Address</p>
                    <p class="user"><i class="bi bi-person-bounding-box"></i> <?= htmlspecialchars($fetch_ordered['name']); ?></p>
                    <p class="user"><i class="bi bi-phone"></i> <?= htmlspecialchars($fetch_ordered['number']); ?></p>
                    <p class="user"><i class="bi bi-envelope"></i> <?= htmlspecialchars($fetch_ordered['email']); ?></p>
                    <p class="user"><i class="bi bi-pin-map-fill"></i> <?= htmlspecialchars($fetch_ordered['address']); ?></p>

                    <p class="title">Status</p>
                    <p class="status" style="color:<?php
                        if ($fetch_ordered['status'] == 'delivered') echo 'green';
                        elseif ($fetch_ordered['status'] == 'canceled') echo 'red';
                        else echo 'orange';
                    ?>">
                        <?= ucfirst(htmlspecialchars($fetch_ordered['status'])); ?>
                    </p>

                    <?php if ($fetch_ordered['status'] == 'canceled') { ?>
                        <a href="checkout.php?get_id=<?= htmlspecialchars($fetch_product['id']); ?>" class="btn">Order Again</a>
                    <?php } else { ?>
                        <form method="post">
                            <button type="submit" name="cancel" class="btn" onclick="return confirm('Are you sure you want to cancel this order?');">Cancel Order</button>
                        </form>
                    <?php } ?>
                </div>
            </div>

            <?php
                } else {
                    echo '<p class="empty">Product not found!</p>';
                }
            } else {
                echo '<p class="empty">Order not found!</p>';
            }
            ?>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="code.js" defer></script>
<?php include 'components/alert.php'; ?>
</body>
</html>