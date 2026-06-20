<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("header.php");

// Clear session array
$_SESSION = [];

// Destroy session
session_destroy();

// Redirect to login
header("Location: login.php?msg=logged_out");
exit();
?>