<?php
// Database connection parameters
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "registration1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get attendance details for each student
$query = "SELECT student.enroll, student.full_name, COUNT(a.enroll) as attendance_count 
          FROM student 
          LEFT JOIN attendance a ON student.enroll = a.enroll 
          GROUP BY student.enroll, student.full_name";

$result = $conn->query($query);

// Check if query was executed successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <link rel="stylesheet" href="viewattendance.css">
</head>
<body>
    <div class="container">
        <h2>Student Attendance</h2>
        <table>
            <thead>
                <tr>
                    <th>Enrollment Number</th>
                    <th>Name</th>
                    <th>Attendance Count</th>
                    <th>View Attendance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["enroll"] . "</td>";
                        echo "<td>" . $row["full_name"] . "</td>";
                        echo "<td>" . $row["attendance_count"] . "</td>";
                        echo "<td><button onclick=\"viewAttendance('" . $row["enroll"] . "')\">View</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function viewAttendance(enroll) {
            // Redirect to a new page to view attendance details for the given enrollment number
            window.location.href = "view_attendance.php?enroll=" + enroll;
        }
    </script>
</body>
</html>
