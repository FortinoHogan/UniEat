<?php

require 'functions.php';

if (isset($_POST['register'])) {

    if (registerCustomer($_POST) > 0) {

        echo "
            <script>
                alert('User berhasil ditambahkan!');
            </script>
            ";
    } else {

        echo "
            <script>
                alert('User gagal ditambahkan!');
            </script>
            ";
    }
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
        <form action="" method="post" onsubmit="return registerValidation()">
            <input type="text" name="email" id="email" placeholder="Email">
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Phone Number">
            <input type="password" name="password" id="password" placeholder="Password">
            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
            <button type="submit" name="register">Register</button>
            <div>
                Already have an account?<a href="login.php">Login</a>
            </div>
        </form>
    </section>
</body>
<script src="./script/validation.js"></script>

</html>