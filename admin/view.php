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

// Retrieve enroll from URL parameter
$enroll = $_GET['enroll'];

// Retrieve record from database
$sql = "SELECT * FROM student WHERE enroll='$enroll'";
$result = $conn->query($sql);

// Check if record exists
if ($result->num_rows > 0) {
    // Output data of the record
    $row = $result->fetch_assoc();
    $full_name = $row['full_name'];
    $father_name = $row['father_name'];
    $mother_name = $row['mother_name'];
    $date_of_birth = $row['date_of_birth'];
    $mobile_number = $row['mobile_number'];
    $email = $row['email'];
    $category = $row['category'];
    $address = $row['address'];
    $city = $row['city'];
    $pincode = $row['pincode'];
    $department = $row['department'];
    $branch = $row['branch'];
    $course = $row['course'];
    $semester = $row['semester'];
} else {
    echo "Record not found";
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="viewstyle.css"> -->
    <title>Student Details</title>

    <link rel="stylesheet" type="text/css" href="viewstyle.css">
    
    
<body>

<nav class="header">
        <img src="/project1/logo.png" alt="" width="120px" height="">
        <ul>

            <li><a href="adminHome.html">
                    BackToHome </a>
            </li>
            <li>
                <a href="#"> Contact us</a>
            </li>
            <li> <a href="#">
                    Profile </a>
            </li>
            <a href="logout.php">
                <button class="logoutBtn">Logout</button></a>

        </ul>
    </nav>
   <div class="container">
   <button class="button" onclick="goBack()"><img src="/project1/back.svg"  alt=""><span>Back</span></button>
    <div class="form" id="print-content">
        <div class="heading">
          <h1 >Student Details</h1>
        </div>
        <p>Enroll: <?php echo $enroll; ?></p>
        <p>Full Name: <?php echo $full_name; ?></p>
        <p>Father Name: <?php echo $father_name; ?></p>
        <p>Mother Name: <?php echo $mother_name; ?></p>
        <p>Date of Birth: <?php echo $date_of_birth; ?></p>
        <p>Mobile Number: <?php echo $mobile_number; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <p>Category: <?php echo $category; ?></p>
        <p>Address: <?php echo $address; ?></p>
        <p>City: <?php echo $city; ?></p>
        <p>Pincode: <?php echo $pincode; ?></p>
        <p>Department: <?php echo $department; ?></p>
        <p>Branch: <?php echo $branch; ?></p>
        <p>Course: <?php echo $course; ?></p>
        <p>Semester: <?php echo $semester; ?></p>
    </div>
    <div class="print">
        <span class="ifyou"> If you Want to Print Student details <span class="click">click</span> on Print </span>
  <button onclick="printContent()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-printer-fill" viewBox="0 0 16 16">
  <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
  <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
</svg> <span>Print</span></button>
  </div>
  </div>

 



  <script>
        function goBack() {
            window.history.back();
        }
        function printContent() {
        var content = document.getElementById('print-content').innerHTML;
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write('<html><head><title>Print</title>');
        // Include the linked CSS file
        printWindow.document.write('<link rel="stylesheet" type="text/css" href="viewstyle.css">');
        printWindow.document.write('<style>@media print { nav, .print { display: none; } }</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(content);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }


    </script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
