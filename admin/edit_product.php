<?php include("header.php"); ?>
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

// Fetch product safely
$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Product not found");
}

$product = $result->fetch_assoc();

// UPDATE LOGIC
if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];

    $imageName = $product['image'];

    // If new image uploaded
    if (!empty($_FILES['image']['name'])) {

        $imageName = time() . "_" . $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "../uploads/" . $imageName);
    }

    // Secure update
    $update = $conn->prepare("
        UPDATE products 
        SET name=?, price=?, image=? 
        WHERE id=?
    ");

    $update->bind_param("sdsi", $name, $price, $imageName, $id);

    if ($update->execute()) {
        header("Location: products.php");
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<a href="products.php">← Back</a> | 
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