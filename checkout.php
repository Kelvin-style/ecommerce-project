<?php
include("header.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// User must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Cart must not be empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Your cart is empty. <a href='index.php'>Go shopping</a>");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>
    <h1>MyShop Checkout</h1>

    <p>
        Welcome,
        <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>
        |
        <a href="logout.php">Logout</a>
    </p>
</nav>

<h2>Complete Your Order</h2>

<h3>Your Order Summary</h3>

<?php

$total = 0;

foreach ($_SESSION['cart'] as $item) {

    $subtotal = $item['price'] * $item['qty'];

    $total += $subtotal;

    echo "<p>";
    echo htmlspecialchars($item['name']);
    echo " × ";
    echo $item['qty'];
    echo " = Ksh ";
    echo number_format($subtotal, 2);
    echo "</p>";
}

?>

<h3>Total: Ksh <?php echo number_format($total, 2); ?></h3>

<form method="POST" action="place_order.php">

    <input
        type="text"
        name="name"
        placeholder="Full Name"
        required
    >
    <br><br>

    <input
        type="email"
        name="email"
        placeholder="Email"
        required
    >
    <br><br>

    <input
        type="text"
        name="phone"
        placeholder="Phone Number"
        required
    >
    <br><br>

    <input
        type="text"
        name="address"
        placeholder="Delivery Address"
        required
    >
    <br><br>

    <button type="submit">
        Place Order
    </button>

</form>

</body>
</html>