<?php
// Note this is very similar to createMemberScript.php

// Include database configuration
require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['memberId']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $classification = $_POST['classification'];
    $roles = $_POST['roles'];
    
    // Transaction (If one fails, all fail)
    $conn->begin_transaction();
    try {
        // Prepare and execute member update
        $stmt = $conn->prepare("UPDATE member SET name = ?, email = ?, classification = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $classification, $id);
        $stmt->execute();
    
        // Prepare and execute roles update
        $stmt2 = $conn->prepare("UPDATE roles SET roles = ? WHERE id = ?");
        $stmt2->bind_param("si", $roles, $id);
        $stmt2->execute();
    
        echo "Name: " . htmlspecialchars($name) . "<br>";
        echo "Email: " . htmlspecialchars($email) . "<br>";
        echo "Classification: " . htmlspecialchars($classification) . "<br>";
        echo "Roles: " . htmlspecialchars($roles) . "<br>";
        echo "Update successful.";
        
        // Commit transaction
        $conn->commit();
    
    } catch (Exception $e) {
        $conn->rollback();
        echo "Update failed: " . $e->getMessage();
    } finally {
        if (isset($stmt)) $stmt->close();
        if (isset($stmt2)) $stmt2->close();
        $conn->close();
    }
    
}
?>

