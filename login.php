<?php

session_start();

require 'functions.php';

if (isset($_POST['login'])) {

    $user = $_POST['user'];
    $password = $_POST['password'];

    $resultCustomer = mysqli_query($conn, "SELECT * FROM customers WHERE username = '$user' OR email = '$user'");
    $resultTenant = mysqli_query($conn, "SELECT * FROM tenants WHERE username = '$user' OR email = '$user'");
    $resultAdmin = mysqli_query($conn, "SELECT * FROM admins WHERE username = '$user' OR email = '$user'");

    if (mysqli_num_rows($resultCustomer) === 1) {

        $row = mysqli_fetch_assoc($resultCustomer);
        if (password_verify($password, $row['password'])) {

            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = 'customer';

            header('location: landingPageCustomer.php');
        }
    } else if (mysqli_num_rows($resultTenant) === 1) {

        $row = mysqli_fetch_assoc($resultTenant);
        if (password_verify($password, $row['password'])) {

            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = 'tenant';

            header('location: landingPageTenant.php');
        }
    } else if (mysqli_num_rows($resultAdmin) === 1) {

        $row = mysqli_fetch_assoc($resultAdmin);
        if (password_verify($password, $row['password'])) {

            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = 'admin';

            header('location: landingPageAdmin.php');
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniEat</title>
</head>
<link rel="stylesheet" href="./styles/index.css">

<body>
    <section class="form-container">
        <h1>UniEat</h1>
        <?php if (isset($error)) : ?>
            <p style="color: red;">Password/Username Salah</p>
        <?php endif; ?>
        <form action="" method="post" onsubmit="return loginValidation()">
            <input type="text" name="user" id="user" placeholder="Email/Username">
            <input type="password" name="password" id="password" placeholder="Password">
            <div>
                <a href="forgotPassword.php">Forgot your password?</a>
            </div>
            <button type="submit" name="login">Login</button>
            <div>
                Don't have any account?<a href="register.php">Register</a>
            </div>
        </form>
    </section>
</body>
<script src="./script/validation.js"></script>

</html>