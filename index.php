<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "ecommerce_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Shop</title>

    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #f4f4f4;
        }

        nav {
            background: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
        }

        .price {
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<nav>
    <h1>My Online Shop</h1>
</nav>

<div class="container">

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
?>

<div class="card">
    <img src="uploads/<?php echo $row['product_image']; ?>" alt="">
    <h3><?php echo $row['product_name']; ?></h3>
    <p><?php echo $row['description']; ?></p>
    <p class="price">KES <?php echo $row['product_price']; ?></p>
</div>    

<?php
    }
} else {
    echo "<h3 style='padding:20px;'>No products found</h3>";
}
$conn->close();
?>

</div>

</body>
</html>