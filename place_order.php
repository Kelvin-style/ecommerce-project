<?php
session_start();
include("config/db.php");

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Must be POST request
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: checkout.php");
    exit();
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Get form data
$name    = trim($_POST['name']);
$email   = trim($_POST['email']);
$phone   = trim($_POST['phone']);
$address = trim($_POST['address']);

// Check cart
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Cart is empty");
}

// Calculate total
$total = 0;

foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['qty'];
}

// ==========================
// 1. INSERT INTO ORDERS
// ==========================
$stmt = $conn->prepare("
    INSERT INTO orders 
    (user_id, customer_name, email, phone, address, total_amount, status)
    VALUES (?, ?, ?, ?, ?, ?, 'Pending')
");

$stmt->bind_param(
    "issssd",
    $user_id,
    $name,
    $email,
    $phone,
    $address,
    $total
);

$stmt->execute();

$order_id = $stmt->insert_id;

// ==========================
// 2. INSERT ORDER ITEMS
// ==========================
$stmt2 = $conn->prepare("
    INSERT INTO order_items (order_id, product_name, price, qty)
    VALUES (?, ?, ?, ?)
");

foreach ($_SESSION['cart'] as $item) {

    $stmt2->bind_param(
        "isdi",
        $order_id,
        $item['name'],
        $item['price'],
        $item['qty']
    );

    $stmt2->execute();
}

// ==========================
// 3. CLEAR CART
// ==========================
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Successful</title>

    <style>
        body{
            font-family: Arial;
            background: #f4f4f4;
            text-align: center;
            padding: 40px;
        }

        .box{
            background: white;
            padding: 30px;
            width: 60%;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        a{
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: green;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover{
            background: darkgreen;
        }
    </style>
</head>

<body>

<div class="box">

    <h2>✅ Order Placed Successfully!</h2>

    <p>Thank you, <b><?php echo htmlspecialchars($name); ?></b></p>

    <p>Your Order ID is: <b>#<?php echo $order_id; ?></b></p>

    <p>Total Paid: <b>KES <?php echo number_format($total,2); ?></b></p>

    <p>Status: <b>Pending</b></p>

    <a href="index.php">Continue Shopping</a>

</div>

</body>
</html>