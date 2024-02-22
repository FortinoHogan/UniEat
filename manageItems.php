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
    <section class="menu-section">
        <div class="menu-container">
            <div class="tenant-card">
                <img src="./styles/images/tenant-logos/<?= $_SESSION['logo']; ?>" alt="logo">
                <p><?= $_SESSION['username']; ?></p>
                <a href="newItems.php">New Items</a>
            </div>
            <?php foreach ($menus as $row) : ?>
                <div onclick="location.href='editItem.php?id=<?= $row['id']; ?>';" class="menu-card">
                    <img src="./styles/images/menu-logos/<?= $row['logo']; ?>" alt="logo">
                    <div class="menu-card-detail">
                        <div class="menu-card-atas">
                            <p><?= $row['name']; ?></p>
                            <p><?= $row['description']; ?></p>
                        </div>
                        <div class="menu-card-bawah">
                            <p><?= $row['price']; ?></p>
                            <div>
                                <a href="editItem.php?id=<?= $row['id']; ?>">Edit</a>
                                <a href="deleteItem.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin?');">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>

</html>