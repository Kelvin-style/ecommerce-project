<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../config/db.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $conn->query("DELETE FROM products WHERE id=$id");

    header("Location: products.php");
    exit();
}
?>