<?php
// Include database configuration
require 'db_config.php';

// real_escape_string: Escapes special characters in a string for use in an SQL statement
// Just incase someone tries to inject SQL code using escape characters
$search = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';

// Search query based on input
$sql = "SELECT * FROM event WHERE name LIKE '%$search%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    // htmlspecialchars() is used to prevent XSS attacks, so don't worry about them
    while ($row = $result->fetch_assoc()) {
        echo "<h2>" . htmlspecialchars($row["name"]) . "</h2>" .
             "Date: " . htmlspecialchars($row["date"]) . "<br>" .
             "Time: " . htmlspecialchars($row["time"]) . "<br>" .
             "Location: " . htmlspecialchars($row["location"]) . "<br>" .
             "Info/Details: " . htmlspecialchars($row["info"]) . "<br><br><br>";
    }
} else {
    echo "No events found for the search query.";
}

$conn->close();
?>
