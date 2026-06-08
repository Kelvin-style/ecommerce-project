<?php
$conn = new mysqli("localhost", "root", "", "ecommerce_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Image upload safety fix
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    $target = "uploads/" . $image;

    // Insert into DB
    $sql = "INSERT INTO products (product_name, product_price, product_image, description)
        VALUES ('$name', '$price', '$image', '$description')";
    if ($conn->query($sql) === TRUE) {

        // Move file only if DB insert works
        move_uploaded_file($image_tmp, $target);

        echo "Product added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

<h2>Add Product</h2>

<form method="POST" enctype="multipart/form-data">

    <input type="text" name="name" placeholder="Product Name" required>
    <br><br>

    <input type="number" name="price" placeholder="Price" required>
    <br><br>

    <textarea name="description" placeholder="Description" required></textarea>
    <br><br>

    <input type="file" name="image" required>
    <br><br>

    <button type="submit" name="submit">Add Product</button>

</form>

</body>
</html>