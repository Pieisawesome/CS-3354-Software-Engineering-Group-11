<?php
    $host_name = "localhost";
    $dbUser = "root";
    $dbPassword = '';
    $dbName = "cs3354database";
    $conn = mysqli_connect($host_name, $dbUser, $dbPassword, $dbName);
    if(!$conn)
    {
        die("<div class = 'alert alert-danger'>Something went wrong with the database connection!</div>");
    }

?>