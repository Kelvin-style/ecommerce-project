<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("header.php");
include("../config/db.php");

// Total products
$products = $conn->query("SELECT COUNT(*) AS total FROM products");
$products = $products->fetch_assoc()['total'];

// Total orders
$orders = $conn->query("SELECT COUNT(*) AS total FROM orders");
$orders = $orders->fetch_assoc()['total'];

// Pending orders
$pending = $conn->query("SELECT COUNT(*) AS total FROM orders WHERE status='Pending'");
$pending = $pending->fetch_assoc()['total'];

// Total revenue
$revenue = $conn->query("SELECT SUM(total_amount) AS total FROM orders WHERE status='Delivered'");
$revenue = $revenue->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        .box {
            display: inline-block;
            width: 22%;
            margin: 1%;
            padding: 20px;
            background: white;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        .box h2 {
            margin: 0;
            color: #333;
        }

        .box p {
            font-size: 22px;
            font-weight: bold;
            color: green;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>📊 Admin Dashboard</h1>

    <div class="box">
        <h2>Products</h2>
        <p><?php echo $products; ?></p>
    </div>

    <div class="box">
        <h2>Orders</h2>
        <p><?php echo $orders; ?></p>
    </div>

    <div class="box">
        <h2>Pending</h2>
        <p><?php echo $pending; ?></p>
    </div>

    <div class="box">
        <h2>Revenue</h2>
        <p>KES <?php echo number_format($revenue ?? 0, 2); ?></p>
    </div>

</div>

</body>
</html>