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
    <title>Login Form</title>
</head>
<body>
    <div class = "container">
        <?php
            if (isset($_POST["login"])) 
            {
                $email = $_POST["email"];
                $password = $_POST["password"];
                
                require_once "database.php";
                
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                if ($user) 
                {
                    if (password_verify($password, $user["password"])) 
                    {
                        session_start();
                        $_SESSION["user"] = "true";
                        header("Location: index.php");
                        exit();
                    } else 
                    {
                        echo "<div class = 'alert alert-warning'>Incorrect Password.</div>";
                    }
                } 
                else 
                {
                    echo "<div class = 'alert alert-warning'>Email does not exist.</div>";
                }
            }
        ?>
        <form action= "login.php" method="post">
            <div class = "mb-3">
                <input type="email" class="form-control" name="email" placeholder="Enter Email:" required>
            </div>
            <div class = "mb-3">
                <input type="password" class="form-control" name="password" placeholder="Enter Password:" required>
            </div>
            <div class = "mb-3">
                <button type="submit" name="login" class="btn btn-primary">Login</button>
            </div>
        </form> 
        <div class = "mb-3">
            <p>
                Not Register Yet? <a href="registration.php">Register Here</a>
            </p>
        </div>
    </div>
</body>
</html>
