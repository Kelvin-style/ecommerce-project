<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../config/db.php");

// Validate ID
if (!isset($_GET['id'])) {
    die("Order ID missing");
}

$order_id = $_GET['id'];

// Fetch items
$sql = "SELECT * FROM order_items WHERE order_id=$order_id";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching order items");
}

$total = 0;
?>

<h2>Order Details #<?php echo $order_id; ?></h2>

<a href="orders.php">← Back to Orders</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>Product Name</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Subtotal</th>
    </tr>

<?php
while ($row = $result->fetch_assoc()) {
    $subtotal = $row['price'] * $row['qty'];
    $total += $subtotal;
?>

<tr>
    <td><?php echo $row['product_name']; ?></td>
    <td>Ksh <?php echo $row['price']; ?></td>
    <td><?php echo $row['qty']; ?></td>
    <td>Ksh <?php echo $subtotal; ?></td>
</tr>

<?php } ?>

</table>

<h3>Total: Ksh <?php echo $total; ?></h3>