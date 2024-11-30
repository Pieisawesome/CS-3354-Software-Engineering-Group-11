<?php
// This file is for listing all events

// Include database configuration
require 'db_config.php';

// SQL Query to fetch all events
$query = "SELECT * FROM member";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Output all data
    // Html tags need to be in in double quotes
    while ($row = $result->fetch_assoc()) {
        echo htmlspecialchars($row["name"]) . "<br>";
    }
} else {
    echo "No events found.";
}

$conn->close();
?>
