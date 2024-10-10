<?php
// Start the session
session_start();

// Database connection parameters
$dbhost = 'localhost:3307';
$dbuser = 'root';
$dbpass = '';
$db = 'registration1';

// Check if the form is submitted before accessing POST variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set in $_POST
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['number']) && isset($_POST['password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $password = $_POST['password'];

        // Create connection
        $conn = new mysqli($dbhost, $dbuser, '', $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO register1 (name, email, number, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $name, $email, $number, $password);

        if ($stmt->execute()) {
            echo "New record created successfully";
            // Redirect to login page after successful signup
           
            header("Location: login.html");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close connection
        $conn->close();
    }
}
?>
