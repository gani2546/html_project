<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "feedback_generator";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Extract form data
$branchId = $_POST['branch_id'];
$subjectId = $_POST['subject_id'];
$facultyId = $_POST['faculty_id'];

// Check if a file was uploaded
if (isset($_FILES['csvFile']) && !empty($_FILES['csvFile']['tmp_name'])) {
    // Get file data
    $fileName = $_FILES['csvFile']['name'];
    $fileTmpName = $_FILES['csvFile']['tmp_name'];

    // Read file content
    $fileContent = file_get_contents($fileTmpName);

    // Prepare SQL statement to insert data into feedback_form table
    $sql = "INSERT INTO feedback_form (branch_id, subject_id, faculty_id, csv_file) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $branchId, $subjectId, $facultyId, $fileContent);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Feedback form submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
} else {
    echo "Error: No file uploaded.";
}

// Close connection
$conn->close();
?>
