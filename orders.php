<!DOCTYPE html>
<html>

<head>
    <title>Order History</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>
    <h1>My Orders</h1>
</nav>

<h2>Order History</h2>

<div id="orders"></div>

<h3 id="total-spent"></h3>

<script>

let orders = JSON.parse(localStorage.getItem("orders")) || [];

let ordersDiv = document.getElementById("orders");
let totalSpentText = document.getElementById("total-spent");

let totalSpent = 0;

if (orders.length === 0) {

    ordersDiv.innerHTML = "<p>No orders yet</p>";

} else {

    orders.forEach(order => {

        totalSpent += Number(order.total);

        let box = document.createElement("div");

        box.classList.add("product");

        box.innerHTML = `
            <h3>Order #${order.id}</h3>
            <p>Total: Ksh ${order.total}</p>
            <p>Date: ${order.date}</p>
        `;

        ordersDiv.appendChild(box);

    });

}

totalSpentText.innerText =
"Total Spent: Ksh " + totalSpent;

</script>

</body>

</html>