<?php
// This file is for searching events based on the input of user

// Include database configuration
require 'db_config.php';

// real_escape_string: Escapes special characters in a string for use in an SQL statement
// Just incase someone tries to inject SQL code using escape characters
$search = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';

// Search query based on input
$sql = "SELECT * FROM member WHERE name LIKE '%$search%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    // htmlspecialchars() is used to prevent XSS attacks, so don't worry about them
    // Html tags need to be in in double quotes
    while ($row = $result->fetch_assoc()) {
        echo htmlspecialchars($row["name"]) . "<br>";
    }
} else {
    echo "No members found for the search query.";
}

$conn->close();
?>

