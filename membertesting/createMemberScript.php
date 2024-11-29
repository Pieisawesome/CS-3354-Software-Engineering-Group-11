<?php

require 'db_config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $role = $_POST['role'];

    // Output the form data
    echo "Name: " . $name . "<br>";
    echo "Date: " . $role . "<br>";
   
    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO member (name) VALUES (?)");
    $stmt->bind_param("s", $name); 

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record successfully saved.";
        $mid = $stmt->insert_id; //we will store the id for later use so we dont have to do a select query 
    } else {
        echo "Error: " . $stmt->error;
    }
    // Close the statement 
    $stmt->close();

    //now we make a new statement but this time we use the prev id and put roles. 
    //its supposed to put more than one in different rows 
    //but for now this should be ok 
    $stmt2 = $conn->prepare("INSERT INTO roles (mid, roles) VALUES (?, ?)");
    $stmt2->bind_param("is", $mid, $role); 
    if ($stmt2->execute()) {
        echo "Record successfully saved.";
    } else {
        echo "Error: " . $stmt2->error;
    }
    $stmt2->close();
    //close connection as we completed the transaction
    $conn->close();
}
?>
