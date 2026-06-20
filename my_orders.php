<?php
session_start();
include("config/db.php");

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>

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

        .pending{
            color: orange;
            font-weight: bold;
        }

        .delivered{
            color: green;
            font-weight: bold;
        }

        a{
            text-decoration: none;
            color: blue;
        }
    </style>
</head>

<body>

<div class="container">

<h2>📦 My Orders</h2>

<a href="index.php">← Back to Shop</a>

<br><br>

<?php
$sql = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
?>

<table>
    <tr>
        <th>Order ID</th>
        <th>Total</th>
        <th>Status</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

<?php
while ($row = $result->fetch_assoc()) {
?>

<tr>
    <td>#<?php echo $row['id']; ?></td>

    <td>KES <?php echo number_format($row['total_amount'], 2); ?></td>

    <td>
        <?php if ($row['status'] == "Pending") { ?>
            <span class="pending">Pending</span>
        <?php } else { ?>
            <span class="delivered"><?php echo $row['status']; ?></span>
        <?php } ?>
    </td>

    <td><?php echo $row['created_at']; ?></td>

    <td>
        <a href="view_order.php?id=<?php echo $row['id']; ?>">
            View
        </a>
    </td>
</tr>

<?php } ?>

</table>

<?php
} else {
    echo "<h3>You have no orders yet.</h3>";
}
?>

</div>

</body>
</html>