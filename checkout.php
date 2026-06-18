<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Cart is empty");
}

$total = 0;
?>

<h2>Checkout</h2>

<form method="POST">

    <label>Your Name:</label><br>
    <input type="text" name="customer_name" required>
    <br><br>

    <h3>Order Summary</h3>

<?php
foreach ($_SESSION['cart'] as $item) {
    $subtotal = $item['price'] * $item['qty'];
    $total += $subtotal;

    echo $item['name'] . " - Ksh " . $subtotal . "<br>";
}
?>

    <h3>Total: Ksh <?php echo $total; ?></h3>

    <br>

    <button type="submit" name="place_order">Place Order</button>

</form>

<?php
if (isset($_POST['place_order'])) {

    $name = $_POST['customer_name'];

    // 1. Save order
    $conn->query("INSERT INTO orders (customer_name, total_amount) 
                  VALUES ('$name', '$total')");

    $order_id = $conn->insert_id;

    // 2. Save order items
    foreach ($_SESSION['cart'] as $item) {
        $product_name = $item['name'];
        $price = $item['price'];
        $qty = $item['qty'];

        $conn->query("INSERT INTO order_items (order_id, product_name, price, qty)
                      VALUES ('$order_id', '$product_name', '$price', '$qty')");
    }

    // 3. Clear cart
    unset($_SESSION['cart']);

    echo "<h3>Order placed successfully!</h3>";
    echo "<a href='products.php'>Continue Shopping</a>";
}
?>