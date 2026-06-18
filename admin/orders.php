<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../config/db.php");
?>

<h2>All Orders</h2>

<a href="products.php">← Back</a> |
<a href="logout.php">Logout</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Total</th>
        <th>Status</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

<?php
$result = $conn->query("SELECT * FROM orders ORDER BY id DESC");

while ($row = $result->fetch_assoc()) {
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['customer_name']; ?></td>
    <td>Ksh <?php echo $row['total_amount']; ?></td>

    <td>
        <strong><?php echo $row['status']; ?></strong>
    </td>

    <td><?php echo $row['created_at']; ?></td>

    <td>
        <a href="update_status.php?id=<?php echo $row['id']; ?>">Update Status</a> |
        <a href="view_order.php?id=<?php echo $row['id']; ?>">View</a>
    </td>
</tr>

<?php } ?>

</table>