<?php
session_start();
include("config/db.php");

// Check if product ID was provided
if (!isset($_GET['id'])) {
    die("Product ID is missing.");
}

$id = (int) $_GET['id'];

// Get product from database
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);

// Check if product exists
if (!$result || $result->num_rows == 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();

// Create cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// If product already in cart, increase quantity
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['qty']++;
} else {
    $_SESSION['cart'][$id] = [
        'name'  => $product['name'],
        'price' => $product['price'],
        'image' => $product['image'],
        'qty'   => 1
    ];
}

// Redirect to cart page
header("Location: cart.php");
exit();
?>