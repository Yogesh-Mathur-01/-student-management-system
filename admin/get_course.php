<?php
// Handle the AJAX request
if (isset($_GET['department']) && isset($_GET['branch'])) {
    // Fetch courses based on the selected department and branch
    $selectedDepartment = $_GET['department'];
    $selectedBranch = $_GET['branch'];

    // Connect to the database using prepared statements
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $database = "registration1";
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query with placeholders
    $sql = "SELECT DISTINCT course FROM department WHERE department = ? AND branch = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $selectedDepartment, $selectedBranch);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check for errors
    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }

    // Fetch courses and store them in an array
    $courses = [];
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row['course'];
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();

    // Remove duplicate courses
    $uniqueCourses = array_unique($courses);

    // Return courses as JSON
    header('Content-Type: application/json');
    echo json_encode($uniqueCourses);
}
?>
