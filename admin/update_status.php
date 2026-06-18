<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../config/db.php");

// Check ID
if (!isset($_GET['id'])) {
    die("Order ID missing");
}

$id = $_GET['id'];

// Get order
$order = $conn->query("SELECT * FROM orders WHERE id=$id");

if (!$order || $order->num_rows == 0) {
    die("Order not found");
}

$order = $order->fetch_assoc();

// Update status
if (isset($_POST['update'])) {

    $status = $_POST['status'];

    $conn->query("UPDATE orders SET status='$status' WHERE id=$id");

    header("Location: orders.php");
    exit();
}
?>

<h2>Update Order Status</h2>

<a href="orders.php">← Back</a>

<br><br>

<form method="POST">

    <label>Current Status: <b><?php echo $order['status']; ?></b></label>

    <br><br>

    <select name="status" required>
        <option value="Pending">Pending</option>
        <option value="Processing">Processing</option>
        <option value="Delivered">Delivered</option>
        <option value="Cancelled">Cancelled</option>
    </select>

    <br><br>

    <button type="submit" name="update">Update Status</button>

</form>