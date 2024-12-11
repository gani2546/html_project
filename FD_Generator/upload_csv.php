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

// Check if a file was uploaded
if (isset($_FILES['csvFile']) && !empty($_FILES['csvFile']['tmp_name'])) {
    // Get file data
    $fileName = $_FILES['csvFile']['name'];
    $fileTmpName = $_FILES['csvFile']['tmp_name'];

    // Read file content
    $fileContent = file_get_contents($fileTmpName);

    // Get other form data
    $branchId = $_POST['branch_id'];
    $subjectId = $_POST['subject_id'];
    $facultyId = $_POST['faculty_id'];

    // Prepare SQL statement to insert data into feedback_form table
    $sqlForm = "INSERT INTO feedback_form (branch_id, subject_id, faculty_id, csv_file) VALUES (?, ?, ?, ?)";
    
    // Prepare and check SQL statement
    $stmtForm = $conn->prepare($sqlForm);
    if (!$stmtForm) {
        echo "Error preparing SQL statement: " . $conn->error;
        exit;
    }

    // Bind parameters
    $stmtForm->bind_param("iiis", $branchId, $subjectId, $facultyId, $fileContent);

    // Execute SQL statement for feedback_form table
    if ($stmtForm->execute()) {
        echo "CSV file uploaded and data inserted into feedback_form table successfully!";
    } else {
        echo "Error inserting data into feedback_form table: " . $stmtForm->error;
    }

    // Close statement and connection for feedback_form table
    $stmtForm->close();
    $conn->close();
} else {
    echo "Error: No file uploaded.";
}
?>
