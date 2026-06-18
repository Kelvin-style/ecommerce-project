<?php
session_start();
include("../config/db.php");

// If already logged in → prevent loop
if (isset($_SESSION['admin'])) {
    header("Location: orders.php");
    exit();
}

$error = "";

// LOGIN LOGIC
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // SAFE QUERY (basic version)
    $sql = "SELECT * FROM admin 
            WHERE username='$username' AND password='$password'";

    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {

        $_SESSION['admin'] = $username;

        header("Location: orders.php");
        exit();

    } else {
        $error = "Invalid login details";
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Admin Login</h2>

<form method="POST">

    <input type="text" name="username" placeholder="Username" required>
    <br><br>

    <input type="password" name="password" placeholder="Password" required>
    <br><br>

    <button type="submit" name="login">Login</button>

</form>

<p style="color:red;">
    <?php echo $error; ?>
</p>

</body>
</html>