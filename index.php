<?php
include 'config/db.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>My Online Shop</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav>
    <a href="index.php">Home</a> |
    <a href="cart.php">Cart</a> |
    <a href="admin/add_product.php">Add Product</a> |
    <a href="admin/products.php">Manage Products</a>
</nav>
<hr>

<h1>My Online Shop</h1>

<?php

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
?>

<div class="product">

<img src="uploads/<?php echo $row['image']; ?>">

<h3><?php echo $row['name']; ?></h3>

<p>Ksh <?php echo $row['price']; ?></p>

<a href="product.php?id=<?php echo $row['id']; ?>" class="btn">
View Product
</a>

</div>

<?php } ?>

</body>
</html>