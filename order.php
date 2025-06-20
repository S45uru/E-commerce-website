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
    <title>Green Coffee - ORDER page</title>
</head>
<body>
<?php include 'components/home.php'; ?>

<div class="main">
    <div class="banner">
        <h1>My Order</h1>
    </div>
    <div class="title2">
        <a href="head.php">Home</a><span> / My Order</span>
    </div>

    <section class="orders">
        <div class="box-container">
            <div class="title">
                <img src="components/img/download.png" class="logo">
                <h1>My Order</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed rerum voluptatem vitae, laudantium quos ex omnis laboriosam optio .</p>
            </div>
            <div class="box-container">
                <?php
                $select_ordered = $conn->prepare("SELECT * FROM ordered WHERE user_id = ? ORDER BY id DESC");
                $select_ordered->execute([$user_id]);

                if ($select_ordered->rowCount() > 0) {
                    while ($fetch_ordered = $select_ordered->fetch(PDO::FETCH_ASSOC)) {
                        $select_product = $conn->prepare("SELECT * FROM product WHERE id = ?");
                        $select_product->execute([$fetch_ordered['product_id']]);
                        if ($select_product->rowCount() > 0) {
                            $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="box"<?php if ($fetch_ordered['status'] == 'canceled') echo ' style="border:2px solid red"'; ?>>
                    <a href="view_order.php?get_id=<?= $fetch_ordered['id']; ?>">
                        <p class="date"><i class="bi bi-calendar-fill"></i> <span><?= $fetch_ordered['date'] ?? 'Date not available'; ?></span></p>
                        <img src="images/<?= $fetch_product['image']; ?>" class="image">
                        <div class="row">
                            <h3 class="name"><?= $fetch_product['name']; ?></h3>
                            <p class="price">Price: $<?= $fetch_ordered['price']; ?> x <?= $fetch_ordered['qty']; ?></p>
                            <?php 
                       $status = strtolower(trim($fetch_ordered['status']));
                         $color = 'orange';
                            if ($status == 'delivered') $color = 'green';
                             elseif ($status == 'canceled') $color = 'red';
                                   ?>
                                  <p class="status" style="color:<?= $color; ?>">
                                    <?= ucfirst($status ?: 'pending'); ?>
                                       </p>
                        </div>
                    </a>
                </div>
                <?php
                        }
                    }
                } else {
                    echo '<p class="empty">No orders placed yet!</p>';
                }
                ?>
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