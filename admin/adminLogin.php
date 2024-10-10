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
    $admin_id = $_POST['admin_id'];
    $password = $_POST['password'];

    // Prepare and bind SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id=? AND password=?");
    $stmt->bind_param("ss", $admin_id, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Admin exists, set session variable and redirect
        $_SESSION['admin_id'] = $admin_id;
        $_SESSION['loggedin'] = true;
        header("Location: adminhome.html");
        exit;
    } else {
        // Admin does not exist or invalid credentials, show error message
        echo "<script>alert('Invalid admin ID or password');</script>";
    }
}

// Close connection
$conn->close();
?>
