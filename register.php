<?php
include 'components/connection.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = ''; 
}

if (isset($_POST['submit'])) {
    $id = unique_id(); // Make sure this function is defined
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);

    // ✅ Corrected table name
    $select_user = $conn->prepare("SELECT * FROM userss WHERE email = ?");
    $select_user->execute([$email]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        echo 'Email already exists!';
    } else {
        if ($pass != $cpass) {
            echo 'Confirm password not matched!';
        } else {
            // ✅ Corrected table name
            $insert_user = $conn->prepare("INSERT INTO userss (id, name, email, password) VALUES (?, ?, ?, ?)");
            $insert_user->execute([$id, $name, $email, $pass]);

            // ✅ Corrected table name
            $select_user = $conn->prepare("SELECT * FROM userss WHERE email = ? AND password = ?");
            $select_user->execute([$email, $pass]);
            $row = $select_user->fetch(PDO::FETCH_ASSOC);

            if ($select_user->rowCount() > 0) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                header('location:head.php');
            }
        }
    }
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
        <title>green tea - register now</title>
</head>
<body>
    <div class="main-container">
        <section class="form-container">
            <section class="form-container">
                <div class="title">
                    <img src="components/img/download.png" class="logo">
                    <h1>register now</h1>
                    <p>please fill in the form below</p>
</div>
<form action="" method="post">
    <div class="input-field">
        <p>Your name <sup>*</sup></p>
        <input type="text" name="name" required placeholder="enter your name" maxlength="50">
</div>
<div class="input-field">
        <p>Your email <sup>*</sup></p>
        <input type="email" name="email" required placeholder="enter your email" maxlength="50"
        oninput="this.value = this.value.replace(/\s/g, '')">
</div>
<div class="input-field">
        <p>Your Password<sup>*</sup></p>
        <input type="password" name="pass" required placeholder="enter your password" maxlength="50"
        oninput="this.value = this.value.replace(/\s/g, '')">
</div>
<div class="input-field">
        <p>confirm Password<sup>*</sup></p>
        <input type="password" name="cpass" required placeholder="enter your password" maxlength="50"
        oninput="this.value = this.value.replace(/\s/g, '')">
</div>
<input type="submit" value="register now" class="btn" name="submit">
<p>already have an account? <a href="login.php">login now</a></p>
</form>
</section>
</div>
</body>
</html>