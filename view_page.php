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
}

// Add to wishlist
if (isset($_POST['add_to_wishlist'])) {
    $id = unique_id();
    $product_id = $_POST['product_id'];

    $verify_wishlist = $conn->prepare("SELECT * FROM wishlists WHERE user_id=? AND product_id=?");
    $verify_wishlist->execute([$user_id, $product_id]);

    $verify_cart = $conn->prepare("SELECT * FROM cartt WHERE user_id=? AND product_id=?");
    $verify_cart->execute([$user_id, $product_id]);

    if ($verify_wishlist->rowCount() > 0) {
        $warning_msg[] = 'Product already added to wishlist!';
    } else if ($verify_cart->rowCount() > 0) {
        $warning_msg[] = 'Product already added to cart!';
    } else {
        $select_price = $conn->prepare("SELECT * FROM product WHERE id=? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $insert_wishlist = $conn->prepare("INSERT INTO wishlists (id, user_id, product_id, price) VALUES (?, ?, ?, ?)");
        $insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price']]);

        $success_msg[] = 'Product added to wishlist successfully!';
    }
}

// Add to cart
if (isset($_POST['add_to_cart'])) {
    $id = unique_id();
    $product_id = $_POST['product_id'];

    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);

    $verify_cart = $conn->prepare("SELECT * FROM cartt WHERE user_id=? AND product_id=?");
    $verify_cart->execute([$user_id, $product_id]);

    $max_cart_items = $conn->prepare("SELECT * FROM cartt WHERE user_id=?");
    $max_cart_items->execute([$user_id]);

    if ($verify_cart->rowCount() > 0) {
        $warning_msg[] = 'Product already added to cart!';
    } else if ($max_cart_items->rowCount() > 20) {
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
    <title>Green Coffee - product detail page</title>
</head>
<body>
<?php include 'components/home.php'; ?>

<div class="main">
    <div class="banner">
        <h1>product detail</h1>
    </div>
    <div class="title2">
        <a href="head.php">Home</a><span> / product detail</span>
    </div>

    <section class="view_page">
        <?php
           if(isset($_GET['pid'])){
            $pid=$_GET['pid'];
            $select_product = $conn->prepare("SELECT * FROM product WHERE id='$pid'");
            $select_product->execute();
            if($select_product->rowCount() > 0){
                while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
            
            ?>
            <form method = "post">
                <img src="images/<?php echo $fetch_product['image']; ?>">
                <div class="detail">
                    <div class="price">$<?php echo $fetch_product['price'];?>/-</div>
                    <div class="name"><?php echo $fetch_product['name'];?></div>
                    <div class="detail">
                        <p>Green tea, rich in antioxidants like catechins, offers numerous health benefits, including improved brain function, potential weight loss support, and reduced risk of certain diseases like heart disease and some cancers. </p>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
                    <div class="button">
                        <button type="submit" name="add_to_wishlist" class="btn">add to wishlist<i class ="bx bx_heart"></i></button>
                        <input type="hidden"name="qty" value ="1" min="0" class="quantity">
                        <button type="submit" name="add_to_cart" class="btn">add to cart<i class ="bx bx_cart"></i></button>
                </div>
                </form>
           
           <?php
              }
           }
         }
        ?>
        
    </section>

    <?php include 'components/footer.php'; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="code.js" defer></script>
<?php include 'components/alert.php'; ?>
</body>
</html>