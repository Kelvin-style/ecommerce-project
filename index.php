<?php
include("header.php");
include("config/db.php");

// Get all products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Shop</title>

    <style>
        body{
            font-family: Arial;
            margin:0;
            background:#f4f4f4;
        }

        nav{
            background:#333;
            color:white;
            padding:15px;
            text-align:center;
        }

        nav a{
            color:white;
            text-decoration:none;
            margin:0 10px;
        }

        .container{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:20px;
            padding:20px;
        }

        .card{
            background:white;
            padding:15px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,.1);
            text-align:center;
        }

        .card img{
            width:100%;
            height:180px;
            object-fit:cover;
            border-radius:10px;
        }

        .price{
            color:green;
            font-weight:bold;
            margin:10px 0;
        }

        .btn{
            display:inline-block;
            background:#28a745;
            color:white;
            padding:10px 15px;
            text-decoration:none;
            border-radius:5px;
        }

        .btn:hover{
            background:#218838;
        }
    </style>
</head>

<body>

<nav>
    <h1>My Online Shop</h1>

    <p>
        <a href="index.php">Home</a> |
        <a href="cart.php">Cart</a> |
        <a href="my_orders.php">My Orders</a> |

        <?php if(isset($_SESSION['user_name'])){ ?>

            Welcome,
            <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>
            |
            <a href="logout.php">Logout</a>

        <?php } else { ?>

            <a href="login.php">Login</a> |
            <a href="register.php">Register</a>

        <?php } ?>
    </p>
</nav>

<div class="container">

<?php

if($result->num_rows > 0){

    while($row = $result->fetch_assoc()){

?>

<div class="card">

    <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">

    <h3><?php echo htmlspecialchars($row['name']); ?></h3>

    <p><?php echo htmlspecialchars($row['description']); ?></p>

    <p class="price">
        KES <?php echo number_format($row['price'],2); ?>
    </p>

    <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn">
        Add to Cart 🛒
    </a>

</div>

<?php

    }

}else{

    echo "<h3>No products found.</h3>";

}

$conn->close();

?>

</div>

</body>
</html>