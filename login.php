<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    echo "Login attempt received for: " . htmlspecialchars($username);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav>
        <h1>MyShop</h1>
    </nav>

    <form id="login-form">

        <h2>Login</h2>

        <input type="email" id="email" placeholder="Enter Email" required><br><br>

        <input type="password" id="password" placeholder="Enter Password" required><br><br>

        <button type="submit">Login</button>

        <p id="login-message"></p>

        <hr>

        <h2>Register</h2>

        <input type="text" id="register-name" placeholder="Full Name" required><br><br>

        <input type="email" id="register-email" placeholder="Enter Email" required><br><br>

        <input type="password" id="register-password" placeholder="Create Password" required><br><br>

        <button type="button" id="register-btn">Register</button>

        <p id="register-message"></p>

    </form>

    <script>

        // Login
        let loginForm = document.getElementById("login-form");
        let loginMessage = document.getElementById("login-message");

        loginForm.addEventListener("submit", function(event) {

            event.preventDefault();

            loginMessage.innerText = "✅ Login Successful!";

        });

        // Register
        let registerBtn = document.getElementById("register-btn");
        let registerMessage = document.getElementById("register-message");

        registerBtn.addEventListener("click", function() {

            registerMessage.innerText =
            "✅ Registration Successful!";

        });

    </script>

</body>

</html>