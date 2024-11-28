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

    // Output forum data
    // Html tags need to be in in double quotes
    echo "Name: " . $name . "<br>";
    echo "Date: " . $date . "<br>";
    echo "Time: " . $time . "<br>";
    echo "Location: " . $location . "<br>";
    echo "Info: " . $info . "<br>";

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO event (name, date, time, location, info) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss", $name, $date, $time, $location, $info); 

    // Execute statement
    if ($stmt->execute()) {
        echo "Record successfully saved.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
