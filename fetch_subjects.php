<?php
// Database connection
include 'db_connect.php';

// Fetch subjects based on the selected department
if (isset($_POST['department_name'])) {
    $departmentName = $_POST['department_name'];

    $query = "SELECT name FROM Subjects WHERE department_name = '$departmentName'";
    $result = mysqli_query($conn, $query);

    $output = '<option value="">Select Subject</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
    }

    echo $output;
}
?>
