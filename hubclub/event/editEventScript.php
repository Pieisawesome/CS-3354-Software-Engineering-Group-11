<?php
// Include database configuration
require 'db_config.php';

// Check if the 'id' parameter is provided in the GET request
if (isset($_GET['eventId'])) {
    $id = intval($_GET['eventId']);

    // Get event details
    $stmt = $conn->prepare("SELECT * FROM event WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();

        // Return event details as JSON
        // This part was kinda tricky, I found something about JSON
        // It sends the data as a JSON object, which is parsed in the .html
        // This whole part is just to make sure that the eventID given is valid
        // Else it will return an error message
        echo json_encode(["success" => true, "event" => $event]);
    } else {
        echo json_encode(["success" => false, "message" => "Event not found."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "No event ID provided."]);
}

$conn->close();
?>
