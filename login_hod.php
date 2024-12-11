<?php
session_start(); // Start the session

// Include the database connection file
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['hod_username']; // Assuming login form for HOD
    $password = $_POST['hod_password']; // Assuming login form for HOD

    // Prepare a SQL query to check if the provided credentials exist in the HOD table
    $stmt = $conn->prepare("SELECT * FROM hod WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password); // Bind parameters
    $stmt->execute(); // Execute the query
    $result = $stmt->get_result(); // Get the result

    // If there is at least one row returned, the login is successful
    if ($result->num_rows > 0) {
        // Set session variable upon successful login
        $_SESSION['hod_username'] = $username;

        // Redirect to the HOD dashboard
        redirectToDashboard('hod');
        exit();
    }

    // Prepare a SQL query to check if the provided credentials exist in the Principal table
    $stmt = $conn->prepare("SELECT * FROM principal WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password); // Bind parameters
    $stmt->execute(); // Execute the query
    $result = $stmt->get_result(); // Get the result

    // If there is at least one row returned, the login is successful
    if ($result->num_rows > 0) {
        // Set session variable upon successful login
        $_SESSION['principal_username'] = $username;

        // Redirect to the Principal dashboard
        redirectToDashboard('principal');
        exit();
    } else {
        // If no matching rows found, display an error message
        $error = "Invalid username or password!";
        echo "Invalid username or password!";
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
