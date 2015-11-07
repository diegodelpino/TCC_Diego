<?php
$servername = "localhost";
$username = "root";
$password = "Bool21KZ";

// Create connection
$conn = mysqli_connect($servername, $username, $password, "condominio");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>