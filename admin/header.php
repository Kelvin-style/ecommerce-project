<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<nav style="background:#222; padding:10px;">
    <a href="dashboard.php" style="color:white;margin-right:10px;">Dashboard</a>
    <a href="products.php" style="color:white;margin-right:10px;">Products</a>
    <a href="orders.php" style="color:white;margin-right:10px;">Orders</a>
    <a href="add_product.php" style="color:white;margin-right:10px;">Add Product</a>
    <a href="logout.php" style="color:white;margin-right:10px;">Logout</a>
</nav>
<hr>