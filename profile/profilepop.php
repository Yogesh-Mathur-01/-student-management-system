<?php
session_start();

// Check if the user is logged in and session variables are set
if(isset($_SESSION['username']) && isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profileStyle.css">
</head>
<body>
    <button id="profileBtn" class="profile-btn">Profile</button>
    <div id="profilePopup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2>User Profile</h2>
            <div class="profile-info">
                <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
                <!-- <p><strong>Username:</strong> <?php echo $_SESSION['password']; ?></p> -->
                <!-- Add more profile information here -->
            </div>
            <a href="/project1/logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
