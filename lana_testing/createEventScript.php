<?php
// Include database configuration
require 'db_config.php';

// Check if form data was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $info = $_POST['info'];

    // Output the form data
    echo "Name: " . $name . "<br>";
    echo "Date: " . $date . "<br>";
    echo "Time: " . $time . "<br>";
    echo "Location: " . $location . "<br>";
    echo "Info: " . $info . "<br>";

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO event (name, date, time, location, info) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss", $name, $date, $time, $location, $info); 

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record successfully saved.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
