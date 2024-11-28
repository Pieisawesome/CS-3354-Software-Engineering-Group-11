<?php
// Include database configuration
require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['eventId']) ? intval($_POST['eventId']) : 0;

    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM event WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Event successfully deleted.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid event ID.";
    }
}

$conn->close();
?>
