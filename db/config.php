<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "admin";
$password = "6680Afa.";
$database = "Myshop";

//Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection     
if (!$conn) {
    die(mysqli_error($conn));
}

?>
