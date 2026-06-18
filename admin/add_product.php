<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../config/db.php");

if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // ensure uploads folder exists
    move_uploaded_file($tmp, "../uploads/" . $image);

    $sql = "INSERT INTO products (name, price, image, description)
            VALUES ('$name', '$price', '$image', '$description')";

    if ($conn->query($sql)) {
        echo "Product Added Successfully!";
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