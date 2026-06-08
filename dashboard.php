<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <div class="sidebar">
            <h2>MyShop Admin</h2>
            <a href="#">Dashboard</a>
            <a href="#">Products</a>
            <a href="#">Orders</a>
            <a href="#">Customers</a>
            <a href="#">Reports</a>
            <a href="#">Settings</a>
        </div>

        <div class="main">

            <div class="topbar">
                <h1>Dashboard</h1>
                <div class="user">Admin</div>
            </div>

            <div class="cards">
                <div class="card">Products<br><span>120</span></div>
                <div class="card">Orders<br><span>45</span></div>
                <div class="card">Customers<br><span>80</span></div>
                <div class="card">Revenue<br><span>KES 50,000</span></div>
            </div>

            <div class="table-section">
                <h2>Recent Orders</h2>
                <table>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td>#001</td>
                        <td>John Doe</td>
                        <td>Paid</td>
                        <td>KES 2,000</td>
                    </tr>
                    <tr>
                        <td>#002</td>
                        <td>Mary Wanjiku</td>
                        <td>Pending</td>
                        <td>KES 3,500</td>
                    </tr>
                </table>
            </div>

        </div>

    </body>

</html>