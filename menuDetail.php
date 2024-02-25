<?php

require 'functions.php';

session_start();

if (!isset($_SESSION['login'])) {
    header('location: index.php');
    exit;
}
if ($_SESSION['role'] !== 'customer' && $_SESSION['role'] !== 'admin') {
    header('location: landingPageTenant.php');
    exit;
}
if ($_SESSION['role'] !== 'customer' && $_SESSION['role'] !== 'tenant') {
    header('location: landingPageAdmin.php');
    exit;
}

$id = $_GET['id'];

$menu = query("SELECT * FROM menus WHERE id = '$id'")[0];
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
        <div>Shopping Cart</div>
        <div class="dropdown">
            <div class="profile">
                <img src="./styles/images/pp.png" alt="pp">
                <?= $_SESSION['username'] ?>
            </div>
            <div class="dropdown-menus">
                <a href="landingPageCustomer.php">Home</a>
                <a href="">History</a>
                <a href="">Settings</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <hr>
    <section>
        <div class="menu-detail-card">
            <div class="menu-detail-card-content">
                <img id="logo" src="./styles/images/menu-logos/<?= $menu['logo']; ?>" alt="logo">
                <p id="name"><?= $menu['name']; ?></p>
                <p><?= $menu['description']; ?></p>
                <p>Notes:</p>
                <textarea name="" id="notes" cols="30" rows="10"></textarea>
                <div class="add-item-buttons">
                    <button>-</button>
                    <p>0</p>
                    <button>+</button>
                </div>
                <button>Add To Cart</button>
            </div>
        </div>
    </section>
</body>

</html>