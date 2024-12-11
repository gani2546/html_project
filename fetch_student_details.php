<?php

// Database configuration
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "user_authentication"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch student details from the 'student' table
$sql = "SELECT * FROM student Where student_username"; // Assuming you want to fetch details of one student

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch student details
    $row = $result->fetch_assoc();
    
    // Output student details as JSON
    header('Content-Type: application/json');
    echo json_encode($row);
} else {
    // No student found
    echo "No student found";
}

// Close connection
$conn->close();

?>
