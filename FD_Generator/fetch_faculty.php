<?php

// Replace these variables with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "feedback_generator";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Placeholder SQL query to fetch faculty data
$sql = "SELECT id, name FROM faculty";

$result = $conn->query($sql);

$faculty = [];

if ($result->num_rows > 0) {
    // Fetch data from each row and add it to the $faculty array
    while($row = $result->fetch_assoc()) {
        $faculty[] = $row;
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();

// Return faculty data as JSON
echo json_encode($faculty);
