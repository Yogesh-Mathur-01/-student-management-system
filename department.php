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
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost:3307";
            $username = "root"; // Your MySQL username
            $password = ""; // Your MySQL password
            $database = "registration1";
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
                echo '</tr>';
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>