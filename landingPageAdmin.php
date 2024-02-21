<?php
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

require 'functions.php';

$tenant = query("SELECT * FROM tenants");

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
    <section>
        <div class="section-header-admin">
            <p>Shops:</p>
            <a href="registerTenant.php">New Tenant</a>
        </div>
    </section>
    <section class="tenants-section">
        <div class="tenants-card-container">
            <?php foreach ($tenant as $row) : ?>
                <a href="editTenant.php?id=<?= $row['id']; ?>" class="tenant-card">
                    <img src="./styles/images/tenant-logos/<?= $row['logo']; ?>" alt="logo">
                    <p><?= $row['username']; ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </section>
</body>

</html>