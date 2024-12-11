<?php
// Database configuration
$servername = "localhost"; // Change this if your MySQL server is hosted on a different machine
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "user_authentication"; // Change this to the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Connection successful
    // Uncomment the line below if you want to print a success message
    // echo "Connected successfully";
}
?>
