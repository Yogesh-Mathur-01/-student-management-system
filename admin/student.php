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

// Check for duplicate enrollment number
$check_sql = "SELECT enroll FROM student WHERE enroll = ?";
$stmt_check = $conn->prepare($check_sql);
$stmt_check->bind_param("s", $enroll);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    // Enrollment number already exists
    echo "<div class='popup' id='popup'>
            <div class='popup-content' id='popup-content'>
                <img src='error.png' alt=''>
                <h2>Duplicate Entry</h2>
                <p>Enrollment number $enroll already exists. Please use a different enrollment number.</p>
                <button onclick='closePopup()' type='button'>OK</button>
            </div>
          </div>";
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('popup').style.display = 'block';
                document.getElementById('popup-content').style.display = 'block';
            });

            function closePopup() {
                document.getElementById('popup').style.display = 'none';
                document.getElementById('popup-content').style.display = 'none';
            }
          </script>";
    echo "<link rel='stylesheet' type='text/css' href='studentStyle.css'>";
} else {
    // Insert data into database using prepared statements
    $stmt = $conn->prepare("INSERT INTO student (enroll, full_name, father_name, mother_name, date_of_birth, mobile_number, email, category, address, city, pincode, department, branch, course, semester) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssissss", $enroll, $full_name, $father_name, $mother_name, $date_of_birth, $mobile_number, $email, $category, $address, $city, $pincode, $department, $branch, $course, $semester);

    if ($stmt->execute()) {
        // If the query executed successfully (record added)
        echo "<div class='popup' id='popup'>
                <div class='popup-content' id='popup-content'>
                    <img src='tick.png' alt=''>
                    <h2>Thank You!</h2>
                    <p>Your record has been successfully submitted. Thanks!</p>
                    <button onclick='closePopupAndRedirect()' type='button'>OK</button>
                </div>
              </div>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('popup').style.display = 'block';
                    document.getElementById('popup-content').style.display = 'block';
                });

                function closePopupAndRedirect() {
                    document.getElementById('popup').style.display = 'none';
                    document.getElementById('popup-content').style.display = 'none';
                    window.location.href = 'index.php';
                }
              </script>";
        echo "<link rel='stylesheet' type='text/css' href='studentStyle.css'>";
    } else {
        // If the query execution failed
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>