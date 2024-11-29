<?php
// Include database configuration
require 'db_config.php';

// Check if forum data was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve forum data
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $info = $_POST['info'];

    // Prepare and bind SQL statement (Always prepare and bind to prevent SQL injection)
    $stmt = $conn->prepare("INSERT INTO event (name, date, time, location, info) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss", $name, $date, $time, $location, $info); 

    // Execute statement
    if ($stmt->execute()) {
        echo "Name: " . htmlspecialchars($name) . "<br>";
        echo "Date: " . htmlspecialchars($date) . "<br>";
        echo "Time: " . htmlspecialchars($time) . "<br>";
        echo "Location: " . htmlspecialchars($location) . "<br>";
        echo "Info: " . htmlspecialchars($info) . "<br>";
        echo "Event successfully updated.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
