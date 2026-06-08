<!DOCTYPE html>
<html>

<head>
    <title>Product Details</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>
    <h1>Product Details</h1>
</nav>

<div class="product">

    <h2 id="product-name"></h2>

    <p id="product-price"></p>

    <p>
High quality product available at MyShop.
Fast delivery and secure checkout.
</p>

<a href="index.html">
    <button>Back to Store</button>
</a>

</div>

<script>

let params =
new URLSearchParams(window.location.search);

let name = params.get("name");

let price = params.get("price");

document.getElementById("product-name")
.innerText = name;

document.getElementById("product-price")
.innerText = "Price: Ksh " + price;

</script>

</body>

</html>