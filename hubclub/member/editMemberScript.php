<?php
// Include database configuration
require 'db_config.php';

// Check if the 'id' parameter is provided in the GET request
if (isset($_GET['memberId'])) {
    $id = intval($_GET['memberId']);

    // Get member details
    $stmt = $conn->prepare("SELECT * FROM member WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Get member roles
    $stmt2 = $conn->prepare("SELECT * FROM roles WHERE id = ?");
    $stmt2->bind_param("i", $id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result->num_rows > 0) {
        $member = $result->fetch_assoc();
        $roles = $result2->fetch_assoc();

        // Return member details as JSON
        // This part was kinda tricky, I found something about JSON
        // It sends the data as a JSON object, which is parsed in the .html
        // This whole part is just to make sure that the memberID given is valid
        // Else it will return an error message
        echo json_encode(["success" => true, "member" => $member, "roles" => $roles]);
    } else {
        echo json_encode(["success" => false, "message" => "member not found."]);
    }

    $stmt->close();
    $stmt2->close();
} else {
    echo json_encode(["success" => false, "message" => "No member ID provided."]);
}

$conn->close();
?>
