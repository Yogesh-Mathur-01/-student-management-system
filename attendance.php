<!-- <?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve enrollment number and name from form
    $enrollment = $_POST['enrollment'];
    $name = $_POST['name'];

    // Example: Saving data to a file (You might want to use a database in a real application)
    $data = "Enrollment: $enrollment, Name: $name, Date: " . date("Y-m-d H:i:s") . "\n";
    file_put_contents("attendance_log.txt", $data, FILE_APPEND);

    // Display success message
    echo "<h2>Attendance Marked Successfully</h2>";
} else {
    // Redirect if accessed directly
    header("Location: attendance.html");
    exit();
}
?> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
</head>
<body>
    <p>Redirecting to home1.html in <span id="countdown">3</span> seconds...</p>
</body>
</html>


<?php
// Database connection parameters
$servername = "localhost:3307";
$username = "root"; 
$password = ""; 
$dbname = "registration1"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve enrollment number and name from form
    $enroll = $_POST['enroll'];
    $name = $_POST['full_name'];
    
    // Check if student is registered
    $check_query = "SELECT * FROM student WHERE enroll = '$enroll'";
    $result = $conn->query($check_query);
    if ($result->num_rows == 0) {
        echo "<h2>Only registered students can submit attendance.</h2>";
        echo "<script>";
        echo "var countdown = 3;"; // Set initial countdown value
        echo "var countdownInterval = setInterval(function() {";
        echo "    document.getElementById('countdown').innerHTML = countdown;"; // Update countdown value in the HTML element
        echo "    countdown--;"; // Decrement countdown
        echo "    if (countdown < 0) {";
        echo "        clearInterval(countdownInterval);"; // Stop the countdown when it reaches 0
        echo "        window.location.href = 'home1.html';"; // Redirect to home1.html
        echo "    }";
        echo "}, 1000);"; // Run the interval every second (1000 milliseconds)
        echo "</script>";
        exit();
    }

    // Check if student has already submitted attendance for today
    $check_attendance_query = "SELECT * FROM attendance WHERE enroll = '$enroll' AND DATE(date) = CURDATE()";
    $result = $conn->query($check_attendance_query);
    if ($result->num_rows > 0) {
        echo "<h2>You have already submitted attendance for today.</h2>";
        echo "<script>";
        echo "var countdown = 3;"; 
        echo "var countdownInterval = setInterval(function() {";
        echo "    document.getElementById('countdown').innerHTML = countdown;"; 
        echo "    countdown--;"; 
        echo "    if (countdown < 0) {";
        echo "        clearInterval(countdownInterval);"; 
        echo "        window.location.href = 'home1.html';"; 
        echo "    }";
        echo "}, 1000);"; 
        echo "</script>";
        exit();
        
    }

    // Insert attendance record into database
    $insert_query = "INSERT INTO attendance (enroll, name, date) VALUES ('$enroll', '$name', NOW())";
    if ($conn->query($insert_query) === TRUE) {
        echo "<h2>Attendance marked successfully</h2> ";
        echo "<script>";
        echo "var countdown = 3;"; 
        echo "var countdownInterval = setInterval(function() {";
        echo "    document.getElementById('countdown').innerHTML = countdown;"; 
        echo "    countdown--;"; 
        echo "    if (countdown < 0) {";
        echo "        clearInterval(countdownInterval);"; 
        echo "        window.location.href = 'home1.html';"; 
        echo "    }";
        echo "}, 1000);"; 
        echo "</script>";
        exit();
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
} else {
    // Redirect if accessed directly
    header("Location: attendance.html");
    exit();
}

$conn->close();
?>




<!-- <?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve enrollment number from AJAX request
$enroll = $_POST['enroll'];

// Initialize response array
$response = array();

// Check if student is registered
$check_query = "SELECT * FROM student WHERE enroll = '$enroll'";
$result = $conn->query($check_query);
$response['registered'] = $result->num_rows > 0;

// Check if student has already submitted attendance for today
$check_attendance_query = "SELECT * FROM attendance WHERE enroll = '$enroll' AND DATE(date) = CURDATE()";
$result = $conn->query($check_attendance_query);
$response['attendanceSubmitted'] = $result->num_rows > 0;

// Close connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
 -->


