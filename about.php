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
    <title>Green Coffee - about Us page</title>
</head>
<body>
   <?php include 'components/home.php';?>
   <div class="main">
      <div class="banner">
        <h1>About Us</h1>
        </div>
        <div class="title2">
            <a href="head.php">Home</a><span>about </span>
        </div>
        <div class="about-category">
            <div class="box">
                <img src ="components/img/3.png">
                <div class="detail">
                    <span>coffee</span>
                    <h1>lemon green</h1>
                    <a href="view_product.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src ="components/img/2.png">
                <div class="detail">
                    <span>coffee</span>
                    <h1>lemon green</h1>
                    <a href="view_product.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src ="components/img/about.png">
                <div class="detail">
                    <span>coffee</span>
                    <h1>lemon Teaname</h1>
                    <a href="view_product.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="box">
                <img src ="components/img/about-us.jpg">
                <div class="detail">
                    <span>coffee</span>
                    <h1>lemon green</h1>
                    <a href="view_product.php" class="btn">shop now</a>
                </div>
            </div>
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
<div class="about">
    <div class="row">
        <div class="img-box">
            <img src="components/img/3.png">
</div>
<div class="detail">
    <h1>visit our beautiful showroom!</h1>
    <p>Green Coffee is a coffee shop that offers a variety of coffee beans from around the world. We are dedicated to providing our customers with the best coffee experience possible. Our coffee is roasted fresh daily and we offer a variety of blends to suit every taste. We also offer a selection of teas, hot chocolate, and other beverages. Our goal is to provide our customers with the best coffee experience possible, and we are committed to providing the highest quality products and service.
         We look forward to serving you!</p>
         <a href="view_products.php" class="btn">shop now</a>
        </div>
</div>
</div>
<div class="testimonial-container">
    <div class="title">
        <img src="components/img/download.png" class="logo">
        <h1>what our customers say</h1>
        <p>Our customers love our coffee and we love our customers! Here are some of the things they have to say about us:</p>
        </div>
        <div class="container">
            <div class="testimonial-item ">
                <img src="components/img/01.jpg">
                <h1>Sara Smith</h1>
                <p>"I love Green Coffee! The coffee is always fresh and delicious, and the staff is friendly and helpful. I highly recommend Green Coffee to anyone who loves great coffee!"</p>
                </div>
             <div class="testimonial-item">
            <img src="components/img/02.jpg">
             <h1>Tom Smith</h1>
             <p>"Green Coffee is my favorite coffee shop! The coffee is always fresh and delicious, and the staff is friendly and helpful. I love the cozy atmosphere and the great selection of coffee beans. I highly recommend Green Coffee to anyone who loves great coffee!"</p>
             </div>
            <div class="testimonial-item">
            <img src="components/img/03.jpg">
             <h1>Anna Doe</h1>
             <p>"I love Green Coffee! The coffee is always fresh and delicious, and the staff is friendly and helpful. </p>
           </div> 
           <div class="left-arrow" onclick="nextSlide()"><i class="bx bxs-left-arrow-alt"></i></div>
           <div class="right-arrow" onclick="prevSlide()"><i class="bx bxs-right-arrow-alt"></i></div>                
    </div>

</div>
<?php include 'components/footer.php';?>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src= "code.js" defer ></script>
    <?php include 'components/alert.php';?>
    
</body>
</html>