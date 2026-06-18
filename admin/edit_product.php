<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../config/db.php");

// Get ID
if (!isset($_GET['id'])) {
    die("No product ID provided");
}

$id = $_GET['id'];

// Fetch product
$result = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();

// UPDATE LOGIC
if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];

    // Keep old image by default
    $imageName = $product['image'];

    // If new image uploaded
    if (!empty($_FILES['image']['name'])) {

        $imageName = time() . "_" . $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "../uploads/" . $imageName);
    }

    // Update DB
    $conn->query("UPDATE products 
                  SET name='$name', price='$price', image='$imageName' 
                  WHERE id=$id");

    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<body>

<!-- NAVIGATION -->
<a href="products.php">Back</a> | 
<a href="logout.php">Logout</a>

<h2>Edit Product</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Product Name:</label><br>
    <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
    <br><br>

    <label>Price:</label><br>
    <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
    <br><br>

    <label>Current Image:</label><br>
    <?php if (!empty($product['image'])) { ?>
        <img src="../uploads/<?php echo $product['image']; ?>" width="120">
    <?php } ?>
    <br><br>

    <label>Change Image:</label><br>
    <input type="file" name="image">
    <br><br>

    <button type="submit" name="update">Update Product</button>

</form>

</body>
</html>