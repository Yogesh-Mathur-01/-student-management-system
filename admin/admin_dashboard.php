<?php
// Start the session
session_start();

// Check if admin is logged in, otherwise redirect to login page
if (!isset($_SESSION['admin_id']) || !$_SESSION['loggedin']) {
    header("Location: adminLogin.php");
    exit;
}

// Database connection parameters
$dbhost = 'localhost:3307';
$dbuser = 'root';
$dbpass = '';
$db = 'registration1';

// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Count number of student accounts
$sql_count_students = "SELECT COUNT(*) AS num_students FROM register";
$result_count_students = $conn->query($sql_count_students);
$row_count_students = $result_count_students->fetch_assoc();
$num_students = $row_count_students['num_students'];

// List of student accounts
$sql_list_students = "SELECT * FROM register";
$result_list_students = $conn->query($sql_list_students);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashstyle.css">
    <title>Admin Dashboard</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Welcome to Admin Dashboard</h1>
    <h2>Number of Student Accounts: <?php echo $num_students; ?></h2>
    
    <h3>List of Student Accounts:</h3>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile number</th>
            <th>Registration Date</th>
        </tr>
        <?php while ($row = $result_list_students->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['number']; ?></td>
                <td><?php echo $row['Registration_date']; ?></td> <!-- Assuming you have a column named registration_date in your register1 table -->
            </tr>
        <?php endwhile; ?>
    </table>
    
    <!-- <a href="logout.php">Logout</a> -->
</body>
</html>
<?php
// Close connection
$conn->close();
?>
