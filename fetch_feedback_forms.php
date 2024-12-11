<?php
// Establish database connection
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "feedback_generator"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch feedback forms from the database with additional details using joins
$sql = "SELECT f.id, b.name AS branch_name, s.name AS subject_name, fac.name AS faculty_name, f.csv_file, f.created_at 
        FROM feedback_form f 
        JOIN branches b ON f.branch_id = b.id 
        JOIN subjects s ON f.subject_id = s.id 
        JOIN faculty fac ON f.faculty_id = fac.id";
$result = $conn->query($sql);

$feedbackForms = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $feedbackForms[] = $row;
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();

// Return feedback forms data as JSON
header('Content-Type: application/json');
echo json_encode($feedbackForms);
?>
