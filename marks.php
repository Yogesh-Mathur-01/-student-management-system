<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View and Download Uploaded Files</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }



.section {
    margin-bottom: 20px;
}

h3 {
    margin: 30px 20px 10px;
    color: #666;
}
        h2 {
            text-align: center;
            border-bottom: 2px solid;
            font-family: system-ui;
            font-size: 30px;
            margin: 40px 0px;
         background-color: MediumSeaGreen;
            color: white;
           
        }
        ul {
            list-style-type: none;
            margin: 30px;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        .view-link, .download-link {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #007bff;
            color: #007bff;
            background-color: #f8f9fa;
            border-radius: 4px;
            margin: 20px;
        }
        .download-link {
            margin-left: 10px;
        }
    </style>
</head>
<body>

        <div class="container">
    <h2>Marks Files</h2>
    <ul>
        <?php
        // Path to the directory containing uploaded files
        $directory = "/project1/admin/uploads/";

        // Get all files in the directory
        $files = scandir($_SERVER['DOCUMENT_ROOT'] . "/" . $directory);

        // Exclude . and .. from the list
        $files = array_diff($files, array('.', '..'));

        // Display each file as a list item with view and download links
        foreach ($files as $file) {
            $filePath = $directory . $file;
            echo'<h3>Mca second semester</h3> <h4>First Mid-Sem marks</h4>';
            echo "<li><a class='view-link' href='$filePath' target='_blank'>View $file</a>";
            echo "<a class='download-link' href='$filePath' download>Download $file</a></li>";
        }
        ?>
    </ul>
    </div>
</body>
</html>
