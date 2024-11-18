<?php
    session_start();
    if(isset($_SESSION["user"]))
    {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registration Form</title>
</head>
<body>
    <div class ="container">
        <?php
            if (isset($_POST["register"])) 
            {
                $full_name = $_POST["full_name"];
                $email = $_POST["email"];
                $class_level = isset($_POST["class_level"]) ? $_POST["class_level"] : '';
                $password = $_POST["password"];
                $repeat_password = $_POST["repeat_password"];

                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $errors = array();

                if (empty($full_name) || empty($email) || empty($class_level) || empty($password) || empty($repeat_password)) {
                    array_push($errors, "All fields must be filled.");
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid.");
                }

                if (strlen($password) < 8) {
                    array_push($errors, "Password must be at least 8 characters long.");
                }

                if ($password !== $repeat_password) {
                    array_push($errors, "Passwords do not match.");
                }
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $row_count = mysqli_num_rows($result);
                if($row_count > 0)
                {
                    array_push($errors, "Email already registered.");
                }
                if (count($errors) > 0) 
                {
                    foreach ($errors as $error) 
                    {
                        echo "<div class = 'alert alert-warning'>$error</div>";
                    }
                }
                else
                {
                    
                    $sql = "INSERT INTO users (full_name, email, class_level, password) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepare_stmt = mysqli_stmt_prepare($stmt, $sql);
                    if($prepare_stmt)
                    {
                        mysqli_stmt_bind_param($stmt, "ssss", $full_name, $email, $class_level, $password_hash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class = 'alert alert-success'>You are registered successfully.</div>";
                    }
                    else
                    {
                        die("<div class = 'alert alert-danger'>Something went wrong with the database insertion!</div>");
                    }
                }
            }

        ?>
        <form action="registration.php" method="post">
            <div class ="mb-3">
                <input type="text" class="form-control" name="full_name" placeholder="Full Name:">
            </div>
            <div class ="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="mb-3">
                <select class="form-select" name="class_level">
                    <option value="" disabled selected>Select Class Level</option>
                    <option value="Freshman">Freshman</option>
                    <option value="Sophomore">Sophomore</option>
                    <option value="Junior">Junior</option>
                    <option value="Senior">Senior</option>
                </select>
            </div>
            <div class = "mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class = "mb-3">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="mb-3">
                <button type="submit" name="register" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <div class = "mb-3">
            <p>
                Already Registered? <a href="login.php">Login Here</a>
            </p>
        </div>
    </div>
</body>
</html>
