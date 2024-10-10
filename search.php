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

// Initialize variables
$searchQuery = "";
$searchResults = array();

// Check if the search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve search query from the form
    $searchQuery = $_POST["search"];

    // Prepare SQL statement to search for records based on full_name field
    $sql = "SELECT * FROM student WHERE full_name LIKE '%$searchQuery%'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if any records are found
    if ($result->num_rows > 0) {
        // Fetch and store the results in an array
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="searchstyle.css">
    <title>Search Form</title>
</head>
<body>
    <h2>Search Records</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="search">Search by Full Name:</label>
        <input type="text" name="search" id="search" value="<?php echo $searchQuery; ?>">
        <button type="submit">Search</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php if (count($searchResults) > 0): ?>
            <h2>Search Results:</h2>
            <table border="1">
                <tr>
                    <th>Enroll</th>
                    <th>Full Name</th>
                    <th>Father Name</th>
                    <!-- Add more table headers as needed -->
                </tr>
                <?php foreach ($searchResults as $row): ?>
                    <tr>
                        <td><?php echo $row["enroll"]; ?></td>
                        <td><?php echo $row["full_name"]; ?></td>
                        <td><?php echo $row["father_name"]; ?></td>
                        <!-- Display additional fields here -->
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No records found.</p>
        <?php endif; ?>
    <?php endif; ?>

    <style>
        tr{
            width:600px;
        }
    </style>
</body>
</html>
