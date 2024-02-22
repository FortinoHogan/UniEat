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

$id = $_GET["id"];

if (deleteItem($id) > 0) {
    echo "
            <script>
                alert('Item berhasil dihapus!');
                document.location.href = 'manageItems.php';
            </script>
        ";
} else {
    echo "
        <script>
            alert('Item gagal dihapus!');
            document.location.href = 'manageItems.php';
        </script>
        ";
}
