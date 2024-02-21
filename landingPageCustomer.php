<?php
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

require 'functions.php';

$tenant = query("SELECT * FROM tenants");
$category = query("SELECT * FROM categories");

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
        <div class="section-header">
            <button>All</button>
            <?php foreach ($category as $row) : ?>
                <button><?= $row['name']; ?></button>
            <?php endforeach; ?>
        </div>
    </section>
    <section>
        <?php foreach ($tenant as $row) : ?>
            <a href="tenantDetail.php?id=<?= $row['id']; ?>" class="tenant-card">
                <img src="./styles/images/tenant-logos/<?= $row['logo']; ?>" alt="logo">
                <p><?= $row['username']; ?></p>
            </a>
        <?php endforeach; ?>
    </section>
</body>

</html>