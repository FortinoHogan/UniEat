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
    <section>
        <div class="section-header">
            <p>Current Orders:</p>
        </div>
    </section>
</body>

</html>