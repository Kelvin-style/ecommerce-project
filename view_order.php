<?php
session_start();
include("config/db.php");

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check order ID
if (!isset($_GET['id'])) {
    die("Order ID missing");
}

$order_id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];

// Get order (make sure it belongs to logged-in user)
$order_sql = "SELECT * FROM orders WHERE id = $order_id AND user_id = $user_id";
$order_result = $conn->query($order_sql);

if ($order_result->num_rows == 0) {
    die("Order not found or access denied.");
}

$order = $order_result->fetch_assoc();

// Get order items
$items_sql = "SELECT * FROM order_items WHERE order_id = $order_id";
$items_result = $conn->query($items_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Order</title>

    <style>
        body{
            font-family: Arial;
            background: #f4f4f4;
        }

        .container{
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td{
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th{
            background: #333;
            color: white;
        }

        .box{
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        a{
            text-decoration: none;
            color: blue;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>📦 Order Details #<?php echo $order_id; ?></h2>

    <a href="my_orders.php">← Back to My Orders</a>

    <div class="box">
        <p><strong>Status:</strong> <?php echo $order['status']; ?></p>
        <p><strong>Total:</strong> KES <?php echo number_format($order['total_amount'], 2); ?></p>
        <p><strong>Date:</strong> <?php echo $order['created_at']; ?></p>
    </div>

    <h3>Products</h3>

    <table>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>

        <?php
        $grand_total = 0;

        while ($item = $items_result->fetch_assoc()) {

            $subtotal = $item['price'] * $item['qty'];
            $grand_total += $subtotal;
        ?>

        <tr>
            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
            <td>KES <?php echo number_format($item['price'], 2); ?></td>
            <td><?php echo $item['qty']; ?></td>
            <td>KES <?php echo number_format($subtotal, 2); ?></td>
        </tr>

        <?php } ?>

    </table>

    <h3 style="text-align:right;">
        Grand Total: KES <?php echo number_format($grand_total, 2); ?>
    </h3>

</div>

</body>
</html>