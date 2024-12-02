<?php
// Note this is very similar to createEventScript.php

// Include database configuration
require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['eventId']);
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $info = $_POST['info'];

    // Update event details
    $stmt = $conn->prepare("UPDATE event SET name = ?, date = ?, time = ?, location = ?, info = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $name, $date, $time, $location, $info, $id);

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

    $stmt->close();
}

$conn->close();
?>
