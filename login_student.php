<?php
session_start(); // Start the session

// Include the database connection file
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['student_username'];
    $password = $_POST['student_password'];

    // Assuming you are using prepared statements for security
    // Prepare a SQL query to check if the provided credentials exist in the Student table
    $stmt = $conn->prepare("SELECT * FROM Student WHERE student_username = ? AND student_password = ?");
    $stmt->bind_param("ss", $username, $password); // Bind parameters
    $stmt->execute(); // Execute the query
    $result = $stmt->get_result(); // Get the result

    // If there is at least one row returned, the login is successful
    if ($result->num_rows > 0) {
        // Set session variable upon successful login
        $_SESSION['student_username'] = $username;

        // Redirect to the student dashboard
        redirectToDashboard('student');
        exit();
    } else {
        // If no matching rows found, display an error message
        $error = "Invalid username or password!";
        echo "Invalid username! or password!";
    }


    // Close the statement
    $stmt->close();
}

// Function to redirect to dashboard
function redirectToDashboard($role) {
    header("Location: ${role}_dashboard.php");
    exit();
}
?>