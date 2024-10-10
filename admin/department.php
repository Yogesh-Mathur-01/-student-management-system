<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department, Course, and Branch</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        th {
            background-color: #eee;
        }
        form {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input,
        select {
            padding: 5px;
            margin-bottom: 10px;
        }
        button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
    $servername = "localhost:3307";
    $username = "root"; // Your MySQL username
    $password = ""; // Your MySQL password
    $database = "registration1";
    
    // Function to delete a department
    if(isset($_POST['delete_department'])) {
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $department = $_POST['department'];
        $sql_delete = "DELETE FROM department WHERE department=?";
        $stmt = $conn->prepare($sql_delete);
        $stmt->bind_param("s", $department);
        $stmt->execute();
        $conn->close();
        echo '<div>Department deleted successfully!</div>';
    }

    // Function to delete a course
    if(isset($_POST['delete_course'])) {
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $course = $_POST['course'];
        $sql_delete = "DELETE FROM department WHERE course=?";
        $stmt = $conn->prepare($sql_delete);
        $stmt->bind_param("s", $course);
        $stmt->execute();
        $conn->close();
        echo '<div>Course deleted successfully!</div>';
    }

    // Function to delete a branch
    if(isset($_POST['delete_branch'])) {
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $branch = $_POST['branch'];
        $sql_delete = "DELETE FROM department WHERE branch=?";
        $stmt = $conn->prepare($sql_delete);
        $stmt->bind_param("s", $branch);
        $stmt->execute();
        $conn->close();
        echo '<div>Branch deleted successfully!</div>';
    }
    
    if (isset($_POST['submit'])) {
        $department = $_POST['department'];
        $course = $_POST['course'];
        $branch = $_POST['branch'];

        // Save to database
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO department (department, course, branch) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $department, $course, $branch);
        $stmt->execute();
        $conn->close();

        echo '<div>Entry added successfully!</div>';
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="department">Department:</label>
        <input type="text" id="department" name="department">

        <label for="course">Course:</label>
        <input type="text" id="course" name="course">

        <label for="branch">Branch:</label>
        <input type="text" id="branch" name="branch">

        <button type="submit" name="submit">Add Entry</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Department</th>
                <th>Course</th>
                <th>Branch</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = new mysqli($servername, $username, $password, $database);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM department";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['department'] . '</td>';
                echo '<td>' . $row['course'] . '</td>';
                echo '<td>' . $row['branch'] . '</td>';
                // Add delete button for each department
                echo '<td>
                        <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
                            <input type="hidden" name="department" value="'.$row['department'].'">
                            <button type="submit" name="delete_department">Delete Department</button>
                        </form>
                        <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
                            <input type="hidden" name="course" value="'.$row['course'].'">
                            <button type="submit" name="delete_course">Delete Course</button>
                        </form>
                        <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
                            <input type="hidden" name="branch" value="'.$row['branch'].'">
                            <button type="submit" name="delete_branch">Delete Branch</button>
                        </form>
                    </td>';
                echo '</tr>';
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
