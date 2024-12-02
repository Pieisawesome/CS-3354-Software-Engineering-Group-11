<?php
// Include database configuration
require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['memberId']) ? intval($_POST['memberId']) : 0;

    if ($id > 0) {
        $conn->begin_transaction();
        try{
            
            $stmt = $conn->prepare("DELETE FROM member WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $stmt2 = $conn->prepare("DELETE FROM roles WHERE id= ?");
            $stmt2->bind_param("i", $id);
            $stmt2->execute();
        
            $conn->commit();

            echo "Member successfully deleted.";

            $stmt->close();
            $stmt2->close();
        } catch (Exception $e) {
            $conn->rollback();
            echo "Member deletion failed: " . $e->getMessage();
        }
        
    } else {
        echo "Invalid event ID.";
    }
}

$conn->close();
?>
