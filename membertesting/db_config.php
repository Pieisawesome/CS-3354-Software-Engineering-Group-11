<?php
$host = "localhost";
$username = "root";
$password = 'Po$ter18PM';
$database = "cs3354database";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>