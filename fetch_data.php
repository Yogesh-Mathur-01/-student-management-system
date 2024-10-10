<?php
// Connect to the database
$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "registration1";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch branches and courses based on selected department
$selectedDepartment = $_POST['department'];

// Fetch branches and courses corresponding to the selected department
$sql = "SELECT branch, course FROM department WHERE department = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $selectedDepartment);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Return JSON response
echo json_encode($data);

// Close the database connection
$conn->close();
?>
