<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details Form</title>
    <link rel="stylesheet" href="studentStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <!-- add font awesome css cdn link for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <nav class="header">
        <img src="logo.png" alt="" width="120px" height="">
        <ul>
            <li><a href="home1.html">Back to Home </a></li>
            <li><a href="#"> Contact us</a></li>
            <li><a href="#">Profile</a></li>
            <a href="logout.php"><button class="logoutBtn">Logout</button></a>
        </ul>
    </nav>
    <div class="container">
        <h2>Add Student Record</h2>
        <form id="form" action="student.php" method="post" >
            <!-- Personal Details -->
            <div class="section">
                <h3>Personal Details</h3>
                <!-- Other input fields for personal details -->
                <div class="inputClass">
                    <label for="Enroll_no"  >Enroll number</label>
                    <input type="text" name="enroll" class="input_field success " id="Enroll_no" placeholder="Enter enroll number" required>
                    <i class="fa " aria-hidden="true"></i>
                    <span></span>
                </div>
                <div class="inputClass">
                    <label for="">Full name</label>
                    <input type="text" name="full_name" class="input_field success " id="fullname" placeholder="Enter Full Name" required>
                    <i class="fa " aria-hidden="true"></i>
                    <span></span>

                </div>
                <div class="inputClass">
                    <label for="father_name">Father name</label>
                    <input type="text" name="father_name" class="input_field success " id="fathername" placeholder="Enter Father's Name"
                        required>
                    <i class="fa " aria-hidden="true"></i>
                    <span></span>

                </div>
                <div class="inputClass">
                    <label for="mother_name">Mother name</label>
                    <input type="text" name="mother_name" id="mothername" class="success" placeholder="Enter Mother's Name" required>
                    <i class="fa " aria-hidden="true"></i>
                    <span></span>
                </div>
                <div class="inputClass">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date"  name="date_of_birth" id="dob"  class="success" required>
                    <i class="fa " aria-hidden="true"></i>
                    <span></span>

                </div>
                <div class="inputClass">
                    <label for="mobile_number">Mobile number</label>
                    <input type="tel" name="mobile_number" id="mobile"  class="success" placeholder="Enter Mobile Number" required>
                    <i class="fa " aria-hidden="true"></i>
                    <span></span>
                </div>
                <div class="inputClass">
                    <label for="email">Email id</label>
                    <input type="email"  class="success" name="email" placeholder="Enter Email" id="email" required>
                    <i class="fa " aria-hidden="true"></i>
                    <span></span>
                </div>
                <div class="inputClass">
                    <label for="category">Category</label>
                    <select name="category" id="category" name="category" required>
                        <option value="" disabled selected>Select Category</option>
                        <option value="gen">General</option>
                        <option value="obc">OBC</option>
                        <option value="sc">SC</option>
                        <option value="st">ST</option>
                        <option value="other">Other</option>
                    </select>
                    <i class="fa " aria-hidden="true"></i>
                    <span></span>
                </div>
            </div>

            <!-- Address -->
            <div class="section">
                <h3>Address</h3>
                <!-- Other input fields for address -->
                <div class="inputClass">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" placeholder="Enter Address Line" required>
                    <i class="fa " aria-hidden="true"></i>
                    <span></span>
                </div>
                <div class="inputClass">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" placeholder="Enter city" required>
                    <i class="fa " aria-hidden="true"></i>
                    <span></span>
                </div>
                <div class="inputClass">
                    <label for="address">Pin code</label>
                    <input type="number" name="pincode" id="pincode" placeholder="Enter Pin code" required>
                    <i class="fa " aria-hidden="true"></i>
                    <span></span>
                </div>
            </div>

            <!-- Education Details -->
            <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Details</title>
    <!-- Your CSS styles -->
</head>
<body>
    <div class="section">
        <h3>Education Details</h3>
        <div class="inputClass">
            <label for="department">Department</label>
            <select name="department" id="depart" onchange="fetchBranches()" required>
                <option value="" disabled selected>Select Department</option>
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
                
                // Fetch departments from the database
                $sql = "SELECT DISTINCT department FROM department";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['department'] . "'>" . $row['department'] . "</option>";
                    }
                } else {
                    echo "failed";
                }
                ?>
            </select> 
            <i class="fa " aria-hidden="true"></i>
            <span></span>
        </div>
        
        <div class="inputClass">
            <label for="branch">Branch</label>
            <select name="branch" id="branch" onchange="fetchCourses()" required>
                <option value="" disabled selected>Select Branch</option>
            </select>
            <i class="fa " aria-hidden="true"></i>
            <span></span>
        </div>
        
        <div class="inputClass">
            <label for="course">Course</label>
            <select name="course" id="course" required>
                <option value="" disabled selected>Select Course</option>
            </select>
            <i class="fa " aria-hidden="true"></i>
            <span></span>
        </div>
    </div>

    
    
</body>
</html>

                <div class="inputClass">
                    <label for="semester">Semester</label>
                    <input type="number" name="semester" id="semester" placeholder="Enter Semester" required>
                    <i class="fa " aria-hidden="true"></i>
                    <span></span>
                </div>

                <div class="condition">  <p>* Fill data Carefully otherwise once data is submitted You can't change it. </p>
                    <p>* All field are Mandatory to Fill.</p>
              
                </div>

                <div class="inputClass">
                <button type="submit" id="btnsubmit" >Add record</button>
            </div>
            </div>

            <!-- Submit Button -->
           
        
        </form>
    </div>
    <div class="popup" id="popup">
        <div class="popup-content">
                <img src="tick.png" alt="">
                <h2>Thanks You!</h2>
                <p>Your record has been successfully submitted.Thanks!</p>
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



    <script src="studentDscript.js"></script>
 
   
</body>

</html>
