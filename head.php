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
    <title>Green Coffee - head page</title>
</head>
<body>
   <?php include 'components/home.php';?>
   <div class="main">
<section class="home-section">
<div class="slider">
    <div class="slider_slider slide1">
        <div class="overlay"></div>
        <div class="slide-detail">
            <h1>Welcome to my shop</h1>
            <p>lorem ipsum dolor sit amet consector adipsicing elit. id, cum? Corrupti placeat ex</p>
            <a href="view_product.php" class="btn">shop now</a>
</div>
<div class="hero-dec-top"></div>
<div class="hero-dec-bottom"></div>
</div>
<!----slide end--->
<div class="slider_slider slide2">
        <div class="overlay"></div>
        <div class="slide-detail">
            <h1>Welcome to my shop</h1>
            <p>lorem ipsum dolor sit amet consector adipsicing elit. id, cum? Corrupti placeat ex</p>
            <a href="view_product.php" class="btn">shop now</a>
</div>
<div class="hero-dec-top"></div>
<div class="hero-dec-bottom"></div>
</div>
<!----slide end--->
<div class="slider_slider slide3">
        <div class="overlay"></div>
        <div class="slide-detail">
            <h1>Welcome to my shop</h1>
            <p>lorem ipsum dolor sit amet consector adipsicing elit. id, cum? Corrupti placeat ex</p>
            <a href="view_product.php" class="btn">shop now</a>
</div>
<div class="hero-dec-top"></div>
<div class="hero-dec-bottom"></div>
</div>
<!----slide end--->
<div class="slider_slider slide4">
        <div class="overlay"></div>
        <div class="slide-detail">
            <h1>Welcome to my shop</h1>
            <p>lorem ipsum dolor sit amet consector adipsicing elit. id, cum? Corrupti placeat ex</p>
            <a href="view_product.php" class="btn">shop now</a>
</div>
<div class="hero-dec-top"></div>
<div class="hero-dec-bottom"></div>
</div>
<!----slide end--->
 <div class="slider_slider slide5">
        <div class="overlay"></div>
        <div class="slide-detail">
            <h1>Welcome to my shop</h1>
            <p>lorem ipsum dolor sit amet consector adipsicing elit. id, cum? Corrupti placeat ex</p>
            <a href="view_product.php" class="btn">shop now</a>
</div>
<div class="hero-dec-top"></div>
<div class="hero-dec-bottom"></div>
</div>
<!----slide end--->
<div class="left-arrow"><i class="bx bxs-left-arrow"></i></div>
<div class="right-arrow"><i class="bx bxs-right-arrow"></i></div>

</div>
</section>



<!---- home-slider end--->
<section class="thumb">
    <div class ="box-container">
        <div class="box">
            <img src="components/img/thumb2.jpg">
            <h3> green tea</h3>
            <p>lorem ipsum dolor sit amet consector adipsicing elit. id, cum? Corrupti placeat ex</p>
            <i class="bx bx-chevron-right"></i>
        </div>
        <div class="box">
            <img src="components/img/thumb0.jpg">
            <h3> Lemon tea</h3>
            <p>lorem ipsum dolor sit amet consector adipsicing elit. id, cum? Corrupti placeat ex</p>
            <i class="bx bx-chevron-right"></i>
        </div>
        <div class="box">
            <img src="components/img/thumb1.jpg">
            <h3> green coffee</h3>
            <p>lorem ipsum dolor sit amet consector adipsicing elit. id, cum? Corrupti placeat ex</p>
            <i class="bx bx-chevron-right"></i>
        </div>
        <div class="box">
            <img src="components/img/thumb.jpg">
            <h3> green tea</h3>
            <p>lorem ipsum dolor sit amet consector adipsicing elit. id, cum? Corrupti placeat ex</p>
            <i class="bx bx-chevron-right"></i>
        </div>
</div>
</section>
<section class="container">
    <div class="box-container">
        <div class="box">
            <img src = "components/img/about-us.jpg">
        </div>
        <div class="box">
            <img src=" components/img/download.png">
            <span>healthy tea</span>
            <h1>save up to 50% off </h1>
            <p>lorem ipsum dolor sit amet, consectetur adialiquip cincididunt ut labore et dolore magna</p>
</div>
</div>
</section>
<section class="shop">
    <div class="title">
        <img src="components/img/download.png">
        <h1>Trending Products</h1>
</div>
<div class="row">
        <img src="components/img/about.jpg">
        <div class="row-detail">
            <img src="components/img/basil.jpg">
            <div class="top-footer">
                <h1>a cup of green tea makes you healthy </h1>
</div>
</div>
</div>
<div class="box-container">
    <div class="box">
        <img src="components/img/card.jpg">
        <a href="view_products.php" class="btn">shop now</a>
    </div>
    <div class="box">
        <img src="components/img/card0.jpg">
        <a href="view_products.php" class="btn">shop now</a>
    </div>
    <div class="box">
        <img src="components/img/card1.jpg">
        <a href="view_products.php"class="btn">shop now</a>
    </div>
    <div class="box">
        <img src="components/img/card2.jpg">
        <a href="view_products.php" class="btn">shop now</a>
    </div>
    <div class="box">
        <img src="components/img/10.jpg">
        <a href="view_products.php" class="btn">shop now</a>
    </div>
    <div class="box">
        <img src="components/img/10.jpg">
        <a href="view_products.php" class="btn">shop now</a>
    </div>
</div>
</section>
<section class="shop-category">
    <div class="box-container">
        <div class="box">
            <img src="components/img/6.jpg">
            <div class="details">
                <span>BIG OFFERS</span>
                <h1>Extra 15% off</h1>
                <a href="view_products.php" class="btn">shop now</a>
            </div>
        </div>
        <div class="box">
            <img src="components/img/7.jpg">
            <div class="details">
                <span>New in taste</span>
                <h1>coffee house</h1>
                <a href="view_products.php" class="btn">shop now</a>
            </div>
        </div>
</div>
</section>
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
<section class="brand">
    <div class="box-container">
        <div class="box">
            <img src="components/img/brand1.jpg">
        </div>
        <div class="box">
            <img src="components/img/brand2.jpg">
        </div>
        <div class="box">
            <img src="components/img/brand3.jpg">
        </div>
        <div class="box">
            <img src="components/img/brand4.jpg">
        </div>
        <div class="box">
            <img src="components/img/brand5.jpg">
        </div>
    </div>
</section>
<?php include 'components/footer.php';?></div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src= "code.js" defer ></script>

    <?php include 'components/alert.php';?>
    
</body>
</html>