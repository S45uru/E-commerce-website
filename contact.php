<?php include 'components/connection.php';
session_start();
if(isset($_SESSION['user_id'])){
    $user_id=$_SESSION['user_id'];
}
else{
    $user_id='';
}
if(isset($_POST['logout'])){
    session_destroy();
    header('location:login.php');
}
?>
<style type="text/css">
    <?php include 'coder.css'?>
    </style>
   
<!DOCTYPE html>
 <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="coder.css" type="text/css">
    <link href= 'https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel= 'stylesheet'>
    <title>Green Coffee - home page</title>
</head>
<body>
   <?php include 'components/home.php';?>
   <div class="main">
   <div class="banner">
        <h1>Contact Us</h1>
        </div>
        <div class="title2">
            <a href="head.php">Home</a><span>contact us </span>
        </div>
        <section class="services">
    <div class="box-container">
        <div class="box">
            <img src="components/img/icon2.png">
            <div class="detail">
                <h3> great savings</h3>
                <p>save big every order</p>
            </div>
        </div>
        <div class="box">
            <img src="components/img/icon1.png">
            <div class="detail">
                <h3> 24*7 support</h3>
                <p>one-on-one support</p>
            </div>
        </div>
        <div class="box">
            <img src="components/img/icon0.png">
            <div class="detail">
                <h3>gift vouchers</h3>
                <p>vouchers on every festivals</p>
            </div>
        </div>
        <div class="box">
            <img src="components/img/icon.png">
            <div class="detail">
                <h3> worldwide deliver</h3>
                <p>dropship worldwide</p>
            </div>
        </div>
    </div>
</section>
<div class="form-container">
    <form method="post">
        <div class="title">
            <img src="components/img/download.png" class="logo">
            <h1>leave a message</h1>
</div>
<div class="input-field">
    <p>your name <sup>*</sup></p>
    <input type="text" name="name">
</div>
<div class="input-field">
    <p>your email <sup>*</sup></p>
    <input type="email" name="email">
</div>
<div class="input-field">
    <p>your number<sup>*</sup></p>
    <input type="text" name="number">
</div>
<div class="input-field">
    <p>your message <sup>*</sup></p>
    <textarea name="message"></textarea>
</div>
<button type="submit" name="submit-btn" class="btn">send message</button>
</form>
</div>
<div class="address">
    <div class="title">
        <img src="components/img/download.png" class="logo">
        <h1>contact detail</h1>
        <p>we are here to help you please contact us</p>
</div>
<div class="box-container">
    <div class="box">
        <i class="bx bxs-map-pin"></i>
        <div>
            <h4>address</h4>
            <p>1092 Merigold Lane, Coral Way</p>
</div>
</div>
<div class="box">
        <i class="bx bxs-map-pin"></i>
        <div>
            <h4>phone number</h4>
            <p>8866889955</p>
</div>
</div>
<div class="box">
        <i class="bx bxs-map-pin"></i>
        <div>
            <h4>eamil</h4>
            <p>selenaAnsari@gmail.com</p>
</div>
</div>
</div>
</div>

<?php include 'components/footer.php'?></div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src= "code.js" defer ></script>

    <?php include 'components/alert.php';?>
    
</body>
</html>