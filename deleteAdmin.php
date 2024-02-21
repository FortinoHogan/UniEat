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

$id = $_GET["id"];

if (deleteAdmin($id) > 0) {
    echo "
            <script>
                alert('Admin berhasil dihapus!');
                document.location.href = 'manageAdmin.php';
            </script>
        ";
} else {
    echo "
        <script>
            alert('Admin gagal dihapus!');
            document.location.href = 'manageAdmin.php';
        </script>
        ";
}
