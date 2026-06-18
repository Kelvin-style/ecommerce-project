<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../config/db.php");
?>

<h2>Admin - Manage Products</h2>

<a href="add_product.php">+ Add New Product</a> |
<a href="logout.php">Logout</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Action</th>
    </tr>

<?php
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td>Ksh <?php echo $row['price']; ?></td>

    <td>
        <a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a> |
        <a href="delete_product.php?id=<?php echo $row['id']; ?>"
           onclick="return confirm('Are you sure?')">
           Delete
        </a>
    </td>
</tr>

<?php } ?>

</table>