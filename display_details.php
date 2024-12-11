<?php
session_start(); // Start the session

// Check if user is logged in, if not, return empty JSON
if (!isset($_SESSION['student_username'])) {
    echo json_encode(array());
    exit();
}

// Include the database connection file
include 'db_connect.php';

// Fetch student information from the database based on the student's username
$student_username = $_SESSION['student_username'];
$sql = "SELECT * FROM student WHERE student_username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
?>

<div class="student-details-container">
    <div class="details-box">
        <h1 style="text-align: center;">STUDENT DETAILS</h1>
        <table class="details-table">
            <tr>
                <th>Name</th>
                <td><?php echo $row['Name']; ?></td>
            </tr>
            <tr>
                <th>Roll Number</th>
                <td><?php echo $row['student_username']; ?></td>
            </tr>
            <tr>
                <th>Branch</th>
                <td><?php echo $row['program']; ?></td>
            </tr>
            <tr>
                <th>Regulation</th>
                <td><?php echo $row['regulation']; ?></td>
            </tr>
            <tr>
                <th>Batch</th>
                <td><?php echo $row['batch']; ?></td>
            </tr>
            <tr>
                <th>Year</th>
                <td><?php echo $row['year']; ?></td>
            </tr>
            <tr>
                <th>Semester</th>
                <td><?php echo $row['sem']; ?></td>
            </tr>

        </table>
    </div>
</div>
