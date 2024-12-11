<?php
// Include the database connection file
include 'db_connect.php';

// Start the session
session_start();

// Function to redirect to dashboard
function redirectToDashboard($role) {
    // Define the URL of the dashboard pages based on the user's role
    $dashboardUrls = array(
        'admin' => 'admin_dashboard.php',
        'student' => 'student_dashboard.php'
        // Add more roles and dashboard URLs as needed
    );

    // Check if the role exists in the dashboard URLs array
    if (array_key_exists($role, $dashboardUrls)) {
        // Redirect to the corresponding dashboard URL
        header("Location: " . $dashboardUrls[$role]);
        exit(); // Stop executing the script after redirection
    } else {
        // If role is not found in the array, redirect to a generic dashboard
        header("Location: generic_dashboard.php");
        exit(); // Stop executing the script after redirection
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['admin_username']);
    $password = mysqli_real_escape_string($conn, $_POST['admin_password']);

    // Hash the password (if necessary) before comparing with the database
    // For example: $hashedPassword = hash('sha256', $password);

    // SQL query to check if the provided credentials exist in the Admin table
    $sql = "SELECT * FROM Admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // Check if query execution was successful
    if ($result === false) {
        // Handle query error
        die("Database query failed.");
    }

    // If there is at least one row returned, the login is successful
    if ($result->num_rows > 0) {
        // Store username in session variable
        $_SESSION['admin_username'] = $username;

        // Redirect to the admin dashboard
        redirectToDashboard('admin');
    } else {
        // If no matching rows found, display an error message
        echo "Invalid username or password!";
    }
}
?>