<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "gadgetku";

// Database connection
$conn = mysqli_connect($host, $username, $password, $database);
// Check database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
