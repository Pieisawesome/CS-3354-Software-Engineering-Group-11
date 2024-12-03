<?php
// This file is for listing all events

// Include database configuration
require 'db_config.php';

// SQL Query to fetch all events
$query = "SELECT * FROM member";
$result = $conn->query($query);

echo '<table style="width: 100%; border-collapse: collapse;">';
echo '<thead>';
echo '<tr style="background-color: #ff8300; color: white; text-align: left;">';
echo '<th style="padding: 10px; border: 1px solid #ddd;">Name</th>';
echo '<th style="padding: 10px; border: 1px solid #ddd;">Email</th>';
echo '<th style="padding: 10px; border: 1px solid #ddd;">Classification</th>';
echo '<th style="padding: 10px; border: 1px solid #ddd;">Actions</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

if ($result->num_rows > 0) {
// Loop through the rows and create table rows
while ($row = $result->fetch_assoc()) {
    echo '<tr style="border: 1px solid #ddd; background-color: #f9f9f9;">';
    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($row["name"]) . '</td>';
    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($row["email"]) . '</td>';
    echo '<td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($row["classification"]) . '</td>';
    echo '<td style="padding: 10px; border: 1px solid #ddd;">';
    echo '<button style="background-color: #4CAF50; color: white; border: none; padding: 5px 10px; margin-right: 5px; cursor: pointer;" onclick="editMember(' . $row['id'] . ')">Edit</button>';
    echo '<button style="background-color: #f44336; color: white; border: none; padding: 5px 10px; cursor: pointer;" onclick="deleteMember(' . $row['id'] . ')">Delete</button>';
    echo '</td>';
    echo '</tr>';
    
}
}

echo '</tbody>';
echo '</table>';

$conn->close();










/*
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

$conn->close();*/
?>
