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

if (deleteTenant($id) > 0) {
    echo "
            <script>
                alert('Tenant berhasil dihapus!');
                document.location.href = 'landingpageAdmin.php';
            </script>
        ";
} else {
    echo "
        <script>
            alert('Tenant gagal dihapus!');
            document.location.href = 'landingpageAdmin.php';
        </script>
        ";
}
