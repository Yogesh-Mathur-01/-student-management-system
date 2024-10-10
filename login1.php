<?php
// Start the session
session_start();

// Database connection parameters
$dbhost = 'localhost:3307';
$dbuser = 'root';
$dbpass = '';
$db = 'registration1';

// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM register WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User exists, set session variable and redirect
        $_SESSION['email'] = $email;
        $_SESSION['loggedin'] = true;
        header("Location: home1.html");
        exit;
    } else {
        // User does not exist or invalid credentials, show error message
        echo "<script>alert('Invalid email or password');</script>";
    }
}

// Close connection
$conn->close();
?>
