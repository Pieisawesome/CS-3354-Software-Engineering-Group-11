<?php
// Include database configuration
require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['eventId']);
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $info = $_POST['info'];

    echo "Name: " . $name . "<br>";
    echo "Date: " . $date . "<br>";
    echo "Time: " . $time . "<br>";
    echo "Location: " . $location . "<br>";
    echo "Info: " . $info . "<br>";

    // Update event details
    $stmt = $conn->prepare("UPDATE event SET name = ?, date = ?, time = ?, location = ?, info = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $name, $date, $time, $location, $info, $id);

    if ($stmt->execute()) {
        echo "Event successfully updated.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
