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


$category = query("SELECT * FROM categories");


if (isset($_POST['submit'])) {
    if (addCategory($_POST) > 0) {
        echo "
            <script>
                alert('Kategori berhasil ditambahkan!');
                document.location.href = 'manageCategories.php';
            </script>
            ";
    } else {

        echo "
            <script>
                alert('Kategori gagal ditambahkan!');
            </script>
            ";
    }
}

if (isset($_POST['edit'])) {
    if (editCategory($_POST) > 0) {
        echo "
            <script>
                alert('Kategori berhasil diedit!');
                document.location.href = 'manageCategories.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Kategori gagal diedit!');
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
    <section class="section-header">
        <p>Categories:</p>
    </section>
    <section class="manage-admin-view">
        <div class="category-card-container">
            <button class="new-category-button">New Category</button>
            <?php foreach ($category as $row) : ?>
                <div class="category-card">
                    <p><?= $row['name']; ?></p>
                    <div class="category-card-buttons">
                        <button type="button" class="admin-card" id="edit-category-button" data-category="<?= $row['name']; ?>" data-id="<?= $row['id']; ?>">
                            Edit
                        </button>
                        <a href="deleteCategory.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin?');" class="admin-card">
                            Delete
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="add-category-modal category-modal">
        <form action="" method="post" class="modal-content" onsubmit="return addCategoryValidation()">
            <div class="close">
                <button type="button" class="close-button">&times;</button>
            </div>
            <h1>New Category</h1>
            <div class="new-category-input">
                <label for="category">Category</label>
                <input type="text" name="category" id="category">
            </div>
            <div class="new-category-buttons">
                <button type="submit" name="submit">Save</button>
                <button type="button" class="cancel-button">Cancel</button>
            </div>
        </form>
    </section>

    <section class="edit-category-modal category-modal">
        <form action="" method="post" class="edit-category-content">
            <input type="hidden" name="id" id="id">
            <div class="close">
                <button type="button" class="close-button">&times;</button>
            </div>
            <h1>Edit Category</h1>
            <div class="new-category-input">
                <label for="edit-category">Category</label>
                <input type="text" name="edit-category" id="edit-category">
            </div>
            <div class="new-category-buttons">
                <button type="submit" name="edit">Save</button>
                <button type="button" class="cancel-button">Cancel</button>
            </div>
        </form>
    </section>


</body>
<script src="./script/validation.js"></script>

</html>