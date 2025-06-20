<?php
include 'components/connection.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = ''; 
}

// Register user
if (isset($_POST['submit'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM userss WHERE email = ? AND password = ?");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        header('location:head.php');
    } else {
        echo 'Email or password is incorrect!';
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
    <title>Green Tea - Login Now</title>
</head>
<body>
    <div class="main-container">
        <section class="form-container">
            <div class="title">
                <img src="components/img/download.png" class="logo">
                <h1>Login Now</h1>
                <p>Please fill in the form below</p>
            </div>

            <!-- FIXED: Added missing form tag -->
            <form method="post" action="">
                <div class="input-field">
                    <p>Your Email <sup>*</sup></p>
                    <input type="email" name="email" required placeholder="Enter your email" maxlength="50"
                        oninput="this.value = this.value.replace(/\s/g, '')">
                </div>

                <div class="input-field">
                    <p>Your Password <sup>*</sup></p>
                    <input type="password" name="pass" required placeholder="Enter your password" maxlength="50"
                        oninput="this.value = this.value.replace(/\s/g, '')">
                </div>

                <input type="submit" value="Login Now" class="btn" name="submit">
                <p>You don't have an account? <a href="register.php">Register now</a></p>
            </form>
        </section>
    </div>
</body>
</html>