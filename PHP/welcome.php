<?php
// welcome.php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");  // If the user is not logged in, redirect to login
    exit;
}

echo "Welcome, " . $_SESSION['username'] . "!";
?>
