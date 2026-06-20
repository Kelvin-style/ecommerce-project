<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("header.php");
include("../config/db.php");
?>

<h2>All Orders</h2>

<br><br>

<table border="1" cellpadding="10" width="100%">
    <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Total</th>
        <th>Status</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

<?php
$result = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");

while ($row = $result->fetch_assoc()) {
?>

<tr>
    <td>#<?php echo $row['id']; ?></td>

    <td><?php echo $row['customer_name']; ?></td>

    <td>KES <?php echo number_format($row['total_amount'],2); ?></td>

    <td>
        <?php if ($row['status'] == "Pending") { ?>
            <span style="color:orange;font-weight:bold;">Pending</span>
        <?php } else { ?>
            <span style="color:green;font-weight:bold;">
                <?php echo $row['status']; ?>
            </span>
        <?php } ?>
    </td>

    <td><?php echo $row['created_at']; ?></td>

    <td>
        <a href="view_order.php?id=<?php echo $row['id']; ?>">View</a> |

        <a href="update_status.php?id=<?php echo $row['id']; ?>"
           onclick="return confirm('Update this order status?')">
            Update Status
        </a>
    </td>
</tr>

<?php } ?>

</table>