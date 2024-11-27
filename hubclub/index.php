<?php
    session_start();
    if(!isset($_SESSION["user"]))
    {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Club Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="nav-bar">
        <!-- Hamburger menu for the dropdown -->
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        
        <!-- Centered header -->
        <div class="logo">
            <h1>UTD Club Hub</h1>
        </div>

        <!-- Logout button on the far right -->
        <div class="login-container">
            <button class="login-btn" id="logoutBtn">Logout</button>
        </div>

        <!-- Dropdown for navigation -->
        <div class="dropdown-content" id="dropdown">
            <ul class="nav-links">
                <li><a href="#">Events</a></li>
                <li><a href="#">Members</a></li>
                <li><a href="#">Calendar</a></li>
            </ul>
        </div>

        <!-- Theme toggle button -->
        <div class="theme-toggle">
            <button id="theme-toggle">Light Mode</button>
        </div>
    </div>

    <div class="content">
        <h2>Welcome, [User's Name]</h2>
        <p>Club: [Club Name]</p>
    </div>



    <script src="index.js"></script>
</body>
</html>