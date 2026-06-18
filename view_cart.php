<?php
session_start();
include('config/db.php');

echo "<h2>Shopping Cart 🛒</h2>";

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Cart is empty.";
    exit();
}

$total = 0;

echo "<a href='products.php'>Continue Shopping</a><hr>";

foreach ($_SESSION['cart'] as $id => $qty) {

    $result = $conn->query("SELECT * FROM products WHERE id = $id");

    if ($result->num_rows > 0) {

        $product = $result->fetch_assoc();

        $price = (float)$product['price'];
        $qty = (int)$qty;

        $subtotal = $price * $qty;
        $total += $subtotal;

        echo "<p>";
        echo "<strong>" . $product['name'] . "</strong>";
        echo " | Qty: " . $qty;
        echo " | Ksh " . $subtotal;
        echo " | <a href='remove_from_cart.php?id=$id'>Remove</a>";
        echo "</p>";
    }
}

echo "<hr>";
echo "<h3>Total: Ksh " . $total . "</h3>";

echo "<br><a href='checkout.php'>Proceed to Checkout</a>";
?>