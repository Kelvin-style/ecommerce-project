<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
</head>
<body>

<h2>Your Cart 🛒</h2>

<a href="products.php">Continue Shopping</a>

<br><br>

<?php
$total = 0;

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Cart is empty";
} else {
?>

<table border="1" cellpadding="10">
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Subtotal</th>
        <th>Action</th>
    </tr>

<?php foreach ($_SESSION['cart'] as $id => $item) { 
    $subtotal = $item['price'] * $item['qty'];
    $total += $subtotal;
?>

<tr>
    <td><?php echo $item['name']; ?></td>
    <td>Ksh <?php echo $item['price']; ?></td>
    <td><?php echo $item['qty']; ?></td>
    <td>Ksh <?php echo $subtotal; ?></td>
    <td>
        <a href="remove_from_cart.php?id=<?php echo $id; ?>">Remove</a>
    </td>
</tr>

<?php } ?>

</table>

<h3>Total: Ksh <?php echo $total; ?></h3>

<br>

<a href="checkout.php">
    <button>Proceed to Checkout</button>
</a>

<?php } ?>

</body>
</html>