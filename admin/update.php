<!DOCTYPE html>
<html>
<head>
    <title>Update Student Record</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="updatestyle.css">
</head>
<body>

<?php
// Initialize variables
$enroll="";
$full_name = "";
$father_name = "";
$mother_name = "";
$date_of_birth = "";
$mobile_number = "";
$email = "";
$category = "";
$address = "";
$city = "";
$pincode = "";
$department = "";
$branch = "";
$course = "";
$semester = "";


$servername = "localhost:3307";
$username = "root"; 
$password = ""; 
$database = "registration1";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve enroll from URL parameter
$enroll = $_GET['enroll'];

// Retrieve record from database using prepared statement to prevent SQL injection
$sql = "SELECT * FROM student WHERE enroll=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $enroll);
$stmt->execute();
$result = $stmt->get_result();

// Check if record exists
if ($result->num_rows > 0) {
    // Output data of the record
    $row = $result->fetch_assoc();
    $enroll = $row['enroll'];
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


<div class="container ">
    <h2 class="text-center ">Update Student Record</h2>
    <form method="post"  id="form">
       
        <input type="hidden" class="input_field success"  id="Enroll_no" name="enroll" value="<?php echo $enroll; ?>">
      
        <div class="inputClass">
            <label class="form-label">Full Name</label>
            <input type="text" class="input_field success"  id="fullname" name="full_name" value="<?php echo $full_name; ?>">
            <i class="fa " aria-hidden="true"></i>
                    <span></span>
        </div>
        <div class="inputClass">
            <label class="form-label">Father's Name</label>
            <input type="text"  class="input_field success" id="fathername" name="father_name" value="<?php echo $father_name; ?>">
            <i class="fa " aria-hidden="true"></i>
                    <span></span>
        </div>
        <div class="inputClass">
            <label class="form-label">Mother's Name</label>
            <input type="text"  class="input_field success"  id="mothername" name="mother_name" value="<?php echo $mother_name; ?>">
            <i class="fa " aria-hidden="true"></i>
                    <span></span>
        </div>
        <div class="inputClass">
            <label class="form-label">Date of Birth</label>
            <input type="date"  class="input_field success" id="dob"  name="date_of_birth" value="<?php echo $date_of_birth; ?>">
            <i class="fa " aria-hidden="true"></i>
                    <span></span>
        </div>
        <div class="inputClass">
            <label class="form-label">Mobile Number</label>
            <input type="text"  class="input_field success"  id="mobile" name="mobile_number" value="<?php echo $mobile_number; ?>">
            <i class="fa " aria-hidden="true"></i>
                    <span></span>
        </div>
        <div class="inputClass">
            <label class="form-label">Email</label>
            <input type="email"  class="input_field success" id="email" name="email" value="<?php echo $email; ?>">
            <i class="fa " aria-hidden="true"></i>
                    <span></span>
        </div>
        <div class="inputClass">
            <label class="form-label">Category</label>
            <input type="text"  class="input_field success"  id="category" name="category" value="<?php echo $category; ?>">
            <i class="fa " aria-hidden="true"></i>
                    <span></span>
        </div>
        <div class="inputClass">
            <label class="form-label">Address</label>
            <input type="text"  class="input_field success" id="address"  name="address" value="<?php echo $address; ?>">
            <i class="fa " aria-hidden="true"></i>
                    <span></span>
        </div>
        <div class="inputClass">
            <label class="form-label">City</label>
            <input type="text"  class="input_field success"  id="city" name="city" value="<?php echo $city; ?>">
            <i class="fa " aria-hidden="true"></i>
                    <span></span>
        </div>
        <div class="inputClass">
            <label class="form-label">Pincode</label>
            <input type="text"  class="input_field success" id="pincode" name="pincode" value="<?php echo $pincode; ?>">
            <i class="fa " aria-hidden="true"></i>
                    <span></span>
        </div>
        <div class="section">
    <h3>Education Details</h3>
    <div class="inputClass">
        <label for="department">Department</label>
        <select name="department" id="depart" onchange="getBranch(this) "  required>
            <option value="" disabled>Select Department</option>
            <?php
            // Fetch departments from the database
            $sql_department = "SELECT DISTINCT department FROM department";
            $result_department = $conn->query($sql_department);
            if ($result_department) {
                if ($result_department->num_rows > 0) {
                    while ($row_department = $result_department->fetch_assoc()) {
                        // Check if the department matches the record's department
                        $selected = ($row_department['department'] == $department) ? "selected" : "";
                        echo "<option value='" . $row_department['department'] . "' $selected>" . $row_department['department'] . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No Departments found</option>";
                }
            } else {
                echo "<option value='' disabled>Error fetching departments: " . $conn->error . "</option>";
            }
            ?>
        </select>
        <i class="fa " aria-hidden="true"></i>
        <span></span>
    </div>

    <div class="inputClass">
        <label for="branch">Branch</label>
        <select name="branch" id="branch" onchange="getCourse(this)"  required>
            <option value="" disabled>Select Branch</option>
            <?php
        if (!empty($department)) {
            // Fetch distinct branches from the database based on the selected department
            $sql_branch = "SELECT DISTINCT branch FROM department WHERE department=?";
            $stmt_branch = $conn->prepare($sql_branch);
            $stmt_branch->bind_param("s", $department);
            $stmt_branch->execute();
            $result_branch = $stmt_branch->get_result();
            if ($result_branch) {
                if ($result_branch->num_rows > 0) {
                    while ($row_branch = $result_branch->fetch_assoc()) {
                        // Check if the branch matches the record's branch
                        $selected = ($row_branch['branch'] == $branch) ? "selected" : "";
                        echo "<option value='" . $row_branch['branch'] . "' $selected>" . $row_branch['branch'] . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No Branches found</option>";
                }
            } else {
                echo "<option value='' disabled>Error fetching branches: " . $stmt_branch->error . "</option>";
            }
        }
        ?>

        </select>
        <i class="fa " aria-hidden="true"></i>
        <span></span>
    </div>

    <div class="inputClass">
        <label for="course">Course</label>
        <select name="course" id="course" required>
            <option value="" disabled>Select Course</option>
            <?php
            if (!empty($branch)) {
                // Fetch distinct courses from the database based on the selected branch
                $sql_course = "SELECT DISTINCT course FROM department WHERE branch=?";
                $stmt_course = $conn->prepare($sql_course);
                $stmt_course->bind_param("s", $branch);
                $stmt_course->execute();
                $result_course = $stmt_course->get_result();
                if ($result_course) {
                    if ($result_course->num_rows > 0) {
                        while ($row_course = $result_course->fetch_assoc()) {
                            // Check if the course matches the record's course
                            $selected = ($row_course['course'] == $course) ? "selected" : "";
                            echo "<option value='" . $row_course['course'] . "' $selected>" . $row_course['course'] . "</option>";
                        }
                    } else {
                        echo "<option value='' disabled>No Courses found</option>";
                    }
                } else {
                    echo "<option value='' disabled>Error fetching courses: " . $stmt_course->error . "</option>";
                }
            }
            ?>


        </select>
        <i class="fa " aria-hidden="true"></i>
        <span></span>
    </div>
</div>


        <div class="inputClass">
            <label class="form-label">Semester</label>
            <input type="text"  class="input_field success" id="semester" name="semester" value="<?php echo $semester; ?>">
            <i class="fa " aria-hidden="true"></i>
                    <span></span>
        </div>
        <button type="submit" id="btnsubmit" class="btn btn-primary">Update Record</button>
    </form>
</div>
</div>

</div> 
    <div class="popup" id="popup">
        <div class="popup-content">
                <img src="tick.png" alt="">
                <h2>Thanks You!</h2>
                <p>Record has been successfully Updated.Thanks!</p>
                <button onclick="closepopup()" type="button">OK</button>
        </div>        
    </div>

    <div id="alertModal" class="modal">
    <div class="modal-content">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        <span class="alerttext">Alert</span>
        <span class="close">&times;</span>
        <p id="alertMessage"></p>
  </div>
</div>


<?php


// Handle form submission

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve enroll from URL parameter
    $enroll = $_POST['enroll'];

    // Initialize an empty array to store field updates
    $updates = array();

    // Check if each field is set and add it to the updates array
   
    if (isset($_POST['full_name'])) {
        $updates[] = "full_name='" . $_POST['full_name'] . "'";
    }
    if (isset($_POST['father_name'])) {
        $updates[] = "father_name='" . $_POST['father_name'] . "'";
    }
    if (isset($_POST['mother_name'])) {
        $updates[] = "mother_name='" . $_POST['mother_name'] . "'";
    }
    if (isset($_POST['date_of_birth'])) {
        $updates[] = "date_of_birth='" . $_POST['date_of_birth'] . "'";
    }
    if (isset($_POST['mobile_number'])) {
        $updates[] = "mobile_number='" . $_POST['mobile_number'] . "'";
    }
    if (isset($_POST['email'])) {
        $updates[] = "email='" . $_POST['email'] . "'";
    }
    if (isset($_POST['category'])) {
        $updates[] = "category='" . $_POST['category'] . "'";
    }
    if (isset($_POST['address'])) {
        $updates[] = "address='" . $_POST['address'] . "'";
    }
    if (isset($_POST['city'])) {
        $updates[] = "city='" . $_POST['city'] . "'";
    }
    if (isset($_POST['pincode'])) {
        $updates[] = "pincode='" . $_POST['pincode'] . "'";
    }
    if (isset($_POST['department'])) {
        $updates[] = "department='" . $_POST['department'] . "'";
    }
    if (isset($_POST['branch'])) {
        $updates[] = "branch='" . $_POST['branch'] . "'";
    }
    if (isset($_POST['course'])) {
        $updates[] = "course='" . $_POST['course'] . "'";
    }
    if (isset($_POST['semester'])) {
        $updates[] = "semester='" . $_POST['semester'] . "'";
    }

    // Construct the SET clause for the update statement
    $set_clause = implode(', ', $updates);

    // Update the record in the database
    $sql_update = "UPDATE student SET $set_clause WHERE enroll=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("s", $enroll);
    $stmt->execute();
    echo '  <div class="successIcon">
    <i class="fa fa-check-circle" aria-hidden="true"></i>
    <span class="stext">Record updated SuccessFully</span>
</div>';
    // '<div class="alert alert-success mt-3">Student record updated successfully!</div>';
}

// Close connection
$conn->close();
?>





<script src="update.js"></script>
</body>
</html>
