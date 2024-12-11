<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'feedback_generator';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch feedback data from database
$sql = "SELECT * FROM feedback_form"; // Adjust the query based on your database schema
$result = $conn->query($sql);

// Check if data was fetched successfully
if ($result->num_rows > 0) {
    // Fetch data rows as an associative array
    $feedbackData = array();
    while ($row = $result->fetch_assoc()) {
        $feedbackData[] = $row;
    }

    // Output the feedback data as JSON
    header('Content-Type: application/json');
    echo json_encode($feedbackData);
} else {
    echo "No feedback data found";
}

// Close connection
$conn->close();
?>
