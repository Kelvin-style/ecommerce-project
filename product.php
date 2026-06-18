<?php
session_start();
include("config/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>

<h2>Our Products</h2>

<p>
    <a href="cart.php">
        View Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)
    </a>
</p>

<div style="display:flex; flex-wrap:wrap; gap:20px;">

<?php
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
?>

    <div style="border:1px solid #ccc; padding:15px; width:220px;">

        <h3><?php echo htmlspecialchars($row['name']); ?></h3>

        <p>Price: Ksh <?php echo $row['price']; ?></p>

        <?php if (!empty($row['image'])) { ?>
            <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" width="150">
        <?php } ?>

        <br><br>

        <a href="add_to_cart.php?id=<?php echo $row['id']; ?>">
            <button>Add to Cart</button>
        </a>

    </div>

<?php
    }

} else {
    echo "<p>No products found.</p>";
}
?>

</div>

</body>
</html>