<?php
// Check if file is uploaded successfully
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // Get file details
    $filename = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    
    // Move the uploaded file to a destination directory
    move_uploaded_file($tmp_name, "uploads/" . $filename);
    
    // Print a success message
    echo "File uploaded successfully.";
} else {
    // Print an error message
    echo "Error uploading file.";
}
?>
