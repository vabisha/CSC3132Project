<?php
$servername = "127.0.0.1"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = "mariadb"; // Replace with your database password
$dbname = "project"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
