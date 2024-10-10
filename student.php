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

// Retrieve form data
$enroll = $_POST['enroll'];
$full_name = $_POST['full_name'];
$father_name = $_POST['father_name'];
$mother_name = $_POST['mother_name'];
$date_of_birth = $_POST['date_of_birth'];
$mobile_number = $_POST['mobile_number'];
$email = $_POST['email'];
$category = $_POST['category'];
$address = $_POST['address'];
$city = $_POST['city'];
$pincode = $_POST['pincode'];
$department = $_POST['department'];
$branch = $_POST['branch']; // Note: Corrected typo "brance" to "branch"
$course = $_POST['course'];
$semester = $_POST['semester'];

// Insert data into database
$sql = "INSERT INTO student (enroll, full_name, father_name, mother_name, date_of_birth, mobile_number, email, category, address, city, pincode, department, branch, course, semester)
VALUES ('$enroll', '$full_name', '$father_name', '$mother_name', '$date_of_birth', '$mobile_number', '$email', '$category', '$address', '$city', '$pincode', '$department', '$branch', '$course', '$semester')";

if ($conn->query($sql) === TRUE) {
    // If the query executed successfully (record added)
    echo "<div class='popup' id='popup'>
            <div class='popup-content' id='popup-content'>
                <img src='tick.png' alt=''>
                <h2>Thanks You!</h2>
                <p>Your record has been successfully submitted. Thanks!</p>
                <button onclick='closePopupAndRedirect()' type='button'>OK</button>
            </div>
          </div>";
    // Execute JavaScript for showing the popup
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('popup').style.display = 'block';
                document.getElementById('popup-content').style.display = 'block';

            });

            function closePopupAndRedirect() {
                document.getElementById('popup').style.display = 'none';
                document.getElementById('popup-content').style.display = 'none';

                window.location.href = 'home1.html';
            }
          </script>";

          echo "<link rel='stylesheet' type='text/css' href='studentStyle.css'>";
} else {
    // If there was an error in the query
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>

