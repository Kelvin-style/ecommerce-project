<!DOCTYPE html>
<html>

<head>
    <title>Admin Orders</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav>
        <h1>Admin Orders</h1>
    </nav>

    <h2>Customer Orders</h2>

    <div id="orders-list"></div>

    <script>

        let orders =
        JSON.parse(localStorage.getItem("orders")) || [];

        let ordersList =
        document.getElementById("orders-list");

        if (orders.length === 0) {

            ordersList.innerHTML =
            "<p>No orders found</p>";

        } else {

            orders.forEach(order => {

                let orderCard =
                document.createElement("div");

                orderCard.classList.add("product");

                orderCard.innerHTML = `
                    <h3>Order #${order.id}</h3>
                    <p>Total: Ksh ${order.total}</p>
                    <p>Date: ${order.date}</p>
                    <button class="delete-order">
                        Delete Order
                    </button>
                `;

                let deleteBtn =
                orderCard.querySelector(".delete-order");

                deleteBtn.addEventListener("click", function() {

                    orderCard.remove();

                    orders =
                    orders.filter(o => o.id !== order.id);

                    localStorage.setItem(
                        "orders",
                        JSON.stringify(orders)
                    );

                });

                ordersList.appendChild(orderCard);

            });

        }

    </script>

</body>

</html>