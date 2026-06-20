<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include("header.php"); 
include("../config/db.php");

if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Image upload
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        die("Only JPG, JPEG, PNG, WEBP allowed");
    }

    $newImage = time() . "_" . $image;

    move_uploaded_file($tmp, "../uploads/" . $newImage);

    // Secure insert
    $stmt = $conn->prepare("
        INSERT INTO products (name, price, image, description)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param("sdss", $name, $price, $newImage, $description);

    if ($stmt->execute()) {
        header("Location: products.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Add Product</h2>

<a href="products.php">← Back to Products</a>

<br><br>

<form method="POST" enctype="multipart/form-data">

Name:<br>
<input type="text" name="name" required><br><br>

Price:<br>
<input type="number" name="price" required><br><br>

Description:<br>
<textarea name="description"></textarea><br><br>

Image:<br>
<input type="file" name="image" required><br><br>

<input type="submit" name="add" value="Add Product">

</form>

</body>
</html>