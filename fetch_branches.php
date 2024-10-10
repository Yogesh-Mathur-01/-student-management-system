<?php
// Handle the AJAX request
if (isset($_GET['department'])) {
    // Fetch branches based on the selected department
    $selectedDepartment = $_GET['department'];

    // Connect to the database
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $database = "registration1";
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch branches for the selected department from the database
    $sql = "SELECT DISTINCT branch FROM department WHERE department = '$selectedDepartment'";
    $result = $conn->query($sql);

    // Store branches in an array
    $branches = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $branches[] = $row['branch'];
        }
    }

    // Close database connection
    $conn->close();

    // Return branches as JSON
    header('Content-Type: application/json');
    echo json_encode($branches);
}
?>
