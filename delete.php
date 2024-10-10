<?php
// Establish database connection
$servername = "localhost:3307";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "registration1"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if student enroll is set and valid
if (isset($_GET['enroll']) && !empty($_GET['enroll'])) {
    $enroll = $_GET['enroll'];
    
    // SQL to delete record
    $sql = "DELETE FROM student WHERE enroll = $enroll";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

// Close connection
$conn->close();
?>
