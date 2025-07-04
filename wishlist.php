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
    exit();
}

// Add to cart
if (isset($_POST['add_to_cart'])) {
    $id = unique_id();
    $product_id = $_POST['product_id'];

    $qty = 1;
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);

    $verify_cart = $conn->prepare("SELECT * FROM cartt WHERE user_id=? AND product_id=?");
    $verify_cart->execute([$user_id, $product_id]);

    $max_cart_items = $conn->prepare("SELECT * FROM cartt WHERE user_id=?");
    $max_cart_items->execute([$user_id]);

    if ($verify_cart->rowCount() > 0) {
        $warning_msg[] = 'Product already added to cart!';
    } else if ($max_cart_items->rowCount() >= 20) {
        $warning_msg[] = 'Cart is full!';
    } else {
        $select_price = $conn->prepare("SELECT * FROM product WHERE id=? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $insert_cart = $conn->prepare("INSERT INTO cartt (id, user_id, product_id, price, qty) VALUES (?, ?, ?, ?, ?)");
        $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);

        $success_msg[] = 'Product added to cart successfully!';
    }
}

// Delete item from wishlist
if (isset($_POST['delete_item'])) {
    $wishlist_id = $_POST['wishlist_id'];
    $wishlist_id = filter_var($wishlist_id, FILTER_SANITIZE_STRING);

    $verify_delete_items = $conn->prepare("SELECT * FROM wishlists WHERE id=?");
    $verify_delete_items->execute([$wishlist_id]);

    if ($verify_delete_items->rowCount() > 0) {
        $delete_wishlist_id = $conn->prepare("DELETE FROM wishlists WHERE id=?");
        $delete_wishlist_id->execute([$wishlist_id]);
        $success_msg[] = 'Wishlist item deleted successfully!';
    } else {
        $warning_msg[] = 'Wishlist item already deleted!';
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
    <title>Green Coffee - Wishlist Page</title>
</head>
<body>
<?php include 'components/home.php'; ?>

<div class="main">
    <div class="banner">
        <h1>My Wishlist</h1>
    </div>
    <div class="title2">
        <a href="head.php">Home</a><span> / Wishlist</span>
    </div>

    <section class="products">
        <h1 class="title">Products Added in Wishlist</h1>
        <div class="box-container">
            <?php
            $grand_total = 0;
            $select_wishlist = $conn->prepare("SELECT * FROM wishlists WHERE user_id = ?");
            $select_wishlist->execute([$user_id]);
            if ($select_wishlist->rowCount() > 0) {
                while ($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)) {
                    $select_product = $conn->prepare("SELECT * FROM product WHERE id = ?");
                    $select_product->execute([$fetch_wishlist['product_id']]);
                    if ($select_product->rowCount() > 0) {
                        $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <form method="post" action="" class="box">
                            <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
                            <img src="images/<?= $fetch_product['image']; ?>">
                            <div class="button">
                                <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                                <a href="view_page.php?pid=<?= $fetch_product['id']; ?>" class="bx bxs-show"></a>
                                <button type="submit" name="delete_item" onclick="return confirm('Delete this item?');"><i class="bx bx-x"></i></button>
                            </div>
                            <h3 class="name"><?= $fetch_product['name']; ?></h3>
                            <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
                            <div class="flex">
                                <p class="price">Price $<?= $fetch_product['price']; ?>/-</p>
                            </div>
                            <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn">Buy Now</a>
                        </form>
                        <?php
                        $grand_total += $fetch_product['price'];
                    }
                }
            } else {
                echo '<p class="empty">No products added in wishlist!</p>';
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