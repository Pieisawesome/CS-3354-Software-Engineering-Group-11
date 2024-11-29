<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$skills = $data['skills'] ?? [];
$userId = 1; // Assume user ID 1 for this example

$mysqli = new mysqli('localhost', 'username', 'password', 'your_database');

if ($mysqli->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed']));
}

try {
    $mysqli->begin_transaction();

    // Delete existing skills
    $deleteStmt = $mysqli->prepare("DELETE FROM user_skills WHERE user_id = ?");
    $deleteStmt->bind_param("i", $userId);
    $deleteStmt->execute();
    $deleteStmt->close();

    // Insert new skills
    $insertStmt = $mysqli->prepare("INSERT INTO user_skills (user_id, skill) VALUES (?, ?)");
    foreach ($skills as $skill) {
        $insertStmt->bind_param("is", $userId, $skill);
        $insertStmt->execute();
    }
    $insertStmt->close();

    $mysqli->commit();
    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    $mysqli->rollback();
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
} finally {
    $mysqli->close();
}