
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
}  else {
    echo "No members found for the search query.";
}
    
    echo '</tbody>';
    echo '</table>';

$conn->close();







/*
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

$conn->close();*/
?>

