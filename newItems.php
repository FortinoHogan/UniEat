<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: index.php');
    exit;
}
if ($_SESSION['role'] !== 'tenant' && $_SESSION['role'] !== 'admin') {
    header('location: landingPageCustomer.php');
    exit;
}
if ($_SESSION['role'] !== 'tenant' && $_SESSION['role'] !== 'customer') {
    header('location: landingPageAdmin.php');
    exit;
}

require 'functions.php';

$menus = query("SELECT * FROM menus");

if (isset($_POST['add'])) {
    if (addItem($_POST) > 0) {
        echo "
            <script>
                alert('Item baru berhasil ditambahkan!');
                document.location.href = 'manageItems.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Item baru gagal ditambahkan!');
                document.location.href = 'manageItems.php';
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
                <img src="./styles/images/tenant-logos/<?= $_SESSION['logo']; ?>" alt="pp">
                <?= $_SESSION['username'] ?>
            </div>
            <div class="dropdown-menus-tenant">
                <a href="landingPageTenant.php">Home</a>
                <a href="completedOrders.php">Completed Orders</a>
                <a href="manageItems.php">Manage Items</a>
                <a href="settings.php">Settings</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <hr>
    <section class="form-container addAdmin-form">
        <form action="" method="post" onsubmit="return addItemValidation()" enctype="multipart/form-data">
            <input type="hidden" name="tenant_id" id="tenant_id" value="<?= $_SESSION['id']; ?>">
            <div>
                <label for="gambar">Pictures</label>
                <input type="file" name="gambar" id="gambar">
            </div>
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="input item name">
            </div>
            <div>
                <label for="price">Price</label>
                <input type="text" name="price" id="price" placeholder="input item price">
            </div>
            <div>
                <label for="description">Description</label>
                <input type="text" name="description" id="description" placeholder="input item description">
            </div>
            <button type="submit" name="add">Add Items</button>
        </form>
    </section>
</body>
<script src="./script/validation.js"></script>

</html>