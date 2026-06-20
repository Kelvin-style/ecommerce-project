<?php include("header.php"); ?>
<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../config/db.php");

// Check ID
if (!isset($_GET['id'])) {
    die("Product ID missing");
}

$id = $_GET['id'];

// Prepare delete statement
$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: products.php");
    exit();
} else {
    echo "Error deleting product: " . $conn->error;
}
?>