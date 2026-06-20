<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("header.php");
include("../config/db.php");

// Check ID
if (!isset($_GET['id'])) {
    die("Order ID missing");
}

$id = (int) $_GET['id'];

// Fetch order
$stmt = $conn->prepare("SELECT * FROM orders WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Order not found");
}

$order = $result->fetch_assoc();

// Allowed statuses (IMPORTANT SECURITY FIX)
$allowed_status = ["Pending", "Processing", "Delivered", "Cancelled"];

// Update status
if (isset($_POST['update'])) {

    $status = $_POST['status'];

    if (!in_array($status, $allowed_status)) {
        die("Invalid status value");
    }

    $stmt = $conn->prepare("UPDATE orders SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

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
        <option value="Pending" <?php if($order['status']=="Pending") echo "selected"; ?>>Pending</option>
        <option value="Processing" <?php if($order['status']=="Processing") echo "selected"; ?>>Processing</option>
        <option value="Delivered" <?php if($order['status']=="Delivered") echo "selected"; ?>>Delivered</option>
        <option value="Cancelled" <?php if($order['status']=="Cancelled") echo "selected"; ?>>Cancelled</option>
    </select>

    <br><br>

    <button type="submit" name="update">Update Status</button>

</form>
