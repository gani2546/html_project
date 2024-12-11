<?php
// Check if user is logged in, if not, redirect to login page
session_start(); // Start the session
if (!isset($_SESSION['student_username'])) {
    header("Location: index.php"); // Redirect to login page
    exit();
}

// Include the database connection file
include 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file is uploaded successfully
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Get file details
        $fileName = $_FILES["image"]["name"];
        $fileType = $_FILES["image"]["type"];
        $fileSize = $_FILES["image"]["size"];
        $fileTmpName = $_FILES["image"]["tmp_name"];

        // Read file data
        $fileData = file_get_contents($fileTmpName);

        // Fetch student username from session
        $student_username = $_SESSION['student_username'];

        // Prepare and execute SQL statement to update image data in database
        $sql = "UPDATE student SET profile_image = ? WHERE student_username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $fileData, $student_username);
        $stmt->execute();

        // Check if update was successful
        if ($stmt->affected_rows > 0) {
            echo "Image uploaded successfully.";
        } else {
            echo "Failed to upload image.";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error uploading image.";
    }
}
?>
