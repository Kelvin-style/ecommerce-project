
<?php
session_start();
include("../config/db.php");

if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

// Logout message
if (isset($_GET['msg']) && $_GET['msg'] == "logged_out") {
    echo "<p style='color:green;'>You have been logged out successfully</p>";
}

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Secure query (prevents SQL injection)
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $_SESSION['admin'] = $username;

        header("Location: dashboard.php");
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