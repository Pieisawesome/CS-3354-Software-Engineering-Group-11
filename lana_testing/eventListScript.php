<?php
// Include database configuration
require 'db_config.php';

// SQL query for all events
$query = "SELECT * FROM event";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Output all data
    // htmlspecialchars() is used to prevent XSS attacks, so don't worry about them
    while ($row = $result->fetch_assoc()) {
        echo "<h2>" . htmlspecialchars($row["name"]) . "</h2>" .
             "Date: " . htmlspecialchars($row["date"]) . "<br>" .
             "Time: " . htmlspecialchars($row["time"]) . "<br>" .
             "Location: " . htmlspecialchars($row["location"]) . "<br>" .
             "Info/Details: " . htmlspecialchars($row["info"]) . "<br><br><br>";
    }
} else {
    echo "No events found.";
}

$conn->close();
?>
