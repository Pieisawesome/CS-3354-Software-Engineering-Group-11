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
        echo htmlspecialchars($row["name"]) . " <bk>";
        echo "<button onclick=\"editMember(" . $row["id"] . ")\">Edit</button> ";
        // Delete Button
        echo "<button onclick=\"deleteMember(" . $row["id"] . ")\">Delete " . "</button><br><br>";
    }
} else {
    echo "No members found.";
}

$conn->close();
?>
