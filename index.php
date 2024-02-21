<?php
session_start();

require 'functions.php';

$tenant = query("SELECT * FROM tenants");
$category = query("SELECT * FROM categories")

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
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
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
            <a href="login.php" class="tenant-card">
                <img src="./styles/images/tenant-logos/<?= $row['logo']; ?>" alt="logo">
                <p><?= $row['username']; ?></p>
            </a>
        <?php endforeach; ?>
    </section>
</body>

</html>