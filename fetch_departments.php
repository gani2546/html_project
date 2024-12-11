<?php
// Database connection
include 'db_connect.php';

// Fetch departments from the database
$query = "SELECT name FROM Departments";
$result = mysqli_query($conn, $query);

$output = '<option value="">Select Department</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
}

echo $output;
?>
