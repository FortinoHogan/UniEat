<?php

require 'functions.php';

session_start();

if (!isset($_SESSION['login'])) {
    header('location: index.php');
    exit;
}
if ($_SESSION['role'] !== 'admin'  && $_SESSION['role'] !== 'tenant') {
    header('location: landingPageCustomer.php');
    exit;
}
if ($_SESSION['role'] !== 'admin'  && $_SESSION['role'] !== 'customer') {
    header('location: landingPageTenant.php');
    exit;
}

if (isset($_POST['register'])) {
    if (registerTenant($_POST) > 0) {
        echo "
            <script>
                alert('Tenant berhasil ditambahkan!');
                document.location.href = 'landingpageAdmin.php';
            </script>
            ";
    } else {

        echo "
            <script>
                alert('Tenant gagal ditambahkan!');
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
    <nav class="nav-container">
        <h1>UniEat</h1>
        <div>SearchBar</div>
        <div class="dropdown">
            <div class="profile">
                <img src="./styles/images/pp.png" alt="pp">
                <?= $_SESSION['username'] ?>
            </div>
            <div class="dropdown-menus">
                <a href="landingPageAdmin.php">Home</a>
                <a href="manageAdmin.php">Manage Admin</a>
                <a href="manageCategories.php">Manage Categories</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <hr>
    <section class="form-container addAdmin-form">
        <form action="" method="post" onsubmit="return addTenantValidation()" enctype="multipart/form-data">
            <div>
                <label for="username">Tenant Name</label>
                <input type="text" name="username" id="username" placeholder="input tenant name">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="input tenant email">
            </div>
            <div>
                <label for="phoneNumber">Phone Number</label>
                <input type="text" name="phoneNumber" id="phoneNumber" placeholder="input tenant phone number">
            </div>
            <div>
                <label for="gambar">Tenant Logo</label>
                <input type="file" name="gambar" id="gambar">
            </div>
            <div class="addAdmin-buttons">
                <button type="submit" name="register">Save</button>
                <button type="button" onclick="window.location.href = 'landingpageAdmin.php'">Cancel</button>
            </div>
        </form>
    </section>
</body>
<script src="./script/validation.js"></script>

</html>