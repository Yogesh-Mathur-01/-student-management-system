<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        .view-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 2px 0;
            cursor: pointer;
        }
    </style>
</head>
<body>

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

// Fetch departments, courses, and branches for filtering
$departments_query = "SELECT DISTINCT department FROM student";
$departments_result = $conn->query($departments_query);

$courses_query = "SELECT DISTINCT course FROM student";
$courses_result = $conn->query($courses_query);

$branches_query = "SELECT DISTINCT branch FROM student";
$branches_result = $conn->query($branches_query);

// Pagination
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Initialize filter values
$department = isset($_GET['department']) ? $_GET['department'] : "";
$course = isset($_GET['course']) ? $_GET['course'] : "";
$branch = isset($_GET['branch']) ? $_GET['branch'] : "";

// Retrieve selective fields from database with pagination and filtering
$sql = "SELECT enroll, full_name, father_name, course, semester FROM student WHERE 1=1";

if (!empty($department)) {
    $sql .= " AND department LIKE '%$department%'";
}

if (!empty($course)) {
    $sql .= " AND course LIKE '%$course%'";
}

if (!empty($branch)) {
    $sql .= " AND branch LIKE '%$branch%'";
}

$sql .= " LIMIT $start, $limit";
$result = $conn->query($sql);

// Count the total number of records for pagination
$sql_count = "SELECT COUNT(*) AS total FROM student WHERE 1=1";

if (!empty($department)) {
    $sql_count .= " AND department LIKE '%$department%'";
}

if (!empty($course)) {
    $sql_count .= " AND course LIKE '%$course%'";
}

if (!empty($branch)) {
    $sql_count .= " AND branch LIKE '%$branch%'";
}

$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_pages = ceil($row_count["total"] / $limit);
?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Students Records</h1>
        <form class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label">Department:</label>
                    <select name="department" class="form-select">
                        <option value="">All</option>
                        <?php
                        while ($row = $departments_result->fetch_assoc()) {
                            $selected = ($department == $row['department']) ? 'selected' : '';
                            echo "<option value='" . $row['department'] . "' $selected>" . $row['department'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Branch:</label>
                    <select name="branch" class="form-select">
                        <option value="">All</option>
                        <?php
                        while ($row = $branches_result->fetch_assoc()) {
                            $selected = ($branch == $row['branch']) ? 'selected' : '';
                            echo "<option value='" . $row['branch'] . "' $selected>" . $row['branch'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Course:</label>
                    <select name="course" class="form-select">
                        <option value="">All</option>
                        <?php
                        while ($row = $courses_result->fetch_assoc()) {
                            $selected = ($course == $row['course']) ? 'selected' : '';
                            echo "<option value='" . $row['course'] . "' $selected>" . $row['course'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
                </div>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Enroll</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Course</th>
                    <th>Semester</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are results
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $row["enroll"]; ?></td>
                            <td><?php echo $row["full_name"]; ?></td>
                            <td><?php echo $row["father_name"]; ?></td>
                            <td><?php echo $row["course"]; ?></td>
                            <td><?php echo $row["semester"]; ?></td>
                            <td><a href="view.php?enroll=<?php echo $row["enroll"]; ?>" class="view-btn">View</a></td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        // Pagination links
        if ($page > 1) {
            echo "<a href='?page=" . ($page - 1) . "&department=" . $department . "&course=" . $course . "&branch=" . $branch . "' class='btn btn-secondary me-2'>Previous</a>";
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='?page=" . $i . "&department=" . $department . "&course=" . $course . "&branch=" . $branch . "' class='btn btn-secondary me-2 " . ($page == $i ? 'active' : '') . "'>" . $i . "</a>";
        }
        if ($page < $total_pages) {
            echo "<a href='?page=" . ($page+ 1) . "&department=" . $department . "&course=" . $course . "&branch=" . $branch . "' class='btn btn-secondary ms-2'>Next</a>";
        }
        ?>
    </div>

<?php
// Close connection
$conn->close();
?>

</body>
</html>