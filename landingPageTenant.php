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
