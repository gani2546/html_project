<?php

$servername = "localhost"; // Change this if your MySQL server is hosted on a different machine
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "feedback_generator"; // Change this to the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $branch = $_POST['branch'];
    $subject = $_POST['subject'];
    $faculty = $_POST['faculty'];

    // Prepare an insert statement
    $sql = "INSERT INTO feedback_form (branch_id, subject_id, faculty_id) VALUES (?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sss", $branch, $subject, $faculty);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records inserted successfully. Redirect to success page.
            header("location: feedback_success.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
}
?>
