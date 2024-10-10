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

    // Fetch distinct branches for the selected department from the database
    $sql = "SELECT DISTINCT branch FROM department WHERE department = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedDepartment);
    $stmt->execute();
    $result = $stmt->get_result();

    // Store branches in an array
    $branches = [];
    while ($row = $result->fetch_assoc()) {
        $branches[] = $row['branch'];
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();

    // Remove duplicate branches
    $uniqueBranches = array_unique($branches);

    // Return branches as JSON
    header('Content-Type: application/json');
    echo json_encode($uniqueBranches);
}
?>
