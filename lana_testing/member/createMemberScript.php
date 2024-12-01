<?php

require 'db_config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $classification = $_POST['classification'];
    $roles = $_POST['roles'];

    // Output the form data
    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Classification: " . $classification . "<br>";
    echo "Role: " . $roles . "<br>";
   
    // Transaction (If one fails, all fail)
    $conn->begin_transaction();
    try{
        // Prepare and bind SQL statement for member
        $stmt = $conn->prepare("INSERT INTO member (name, email, classification) VALUES (?,?,?)");
        $stmt->bind_param("sss", $name, $email, $classification); 
        $stmt->execute();// Execute the statement 
        $id = $stmt->insert_id; 

        // Prepare and bind SQL statement for roles
        $stmt2 = $conn->prepare("INSERT INTO roles (id, roles) VALUES (?, ?)");
        $stmt2->bind_param("is", $id, $roles);
        $stmt2->execute();
        $conn->commit();
        echo "Successfully saved. <br>";
        $stmt->close();
        $stmt2->close();
        $conn->close();
    } catch (Exception $e){
        $conn->rollback();
        echo "Error: " . $e->getMessage();
        try{
            $stmt->close();
            $stmt2->close();
            $conn->close();
        } catch (Exception $e){
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
