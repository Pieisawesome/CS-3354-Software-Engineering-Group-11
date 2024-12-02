<?php
// This file is for listing all events

// Include database configuration
require 'db_config.php';

// SQL Query to fetch all events
$query = "SELECT * FROM event";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Output all data
    // Html tags need to be in in double quotes
    while ($row = $result->fetch_assoc()) {
        echo "<h2>" . htmlspecialchars($row["name"]) . "</h2>";
        echo "Date: " . htmlspecialchars($row["date"]) . "<br>";
        echo "Time: " . htmlspecialchars($row["time"]) . "<br>";
        echo "Location: " . htmlspecialchars($row["location"]) . "<br>";
        echo "Info/Details: " . htmlspecialchars($row["info"]) . "<br><br>";
        // Edit Button
        echo "<button onclick=\"editEvent(" . $row["id"] . ")\">Edit</button> ";
        // Delete Button
        echo "<button onclick=\"deleteEvent(" . $row["id"] . ")\">Delete " . "</button><br><br>";
    }
} else {
    echo "No events found.";
}

$conn->close();
?>
