<?php
session_start(); // Start the session

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['student_username'])) {
    header("Location: index.php"); // Redirect to login page
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

// Check if form is submitted for changing password
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate current password
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if current password matches the one in the database
    if (password_verify($currentPassword, $row['password'])) {
        // Check if new password and confirm password match
        if ($newPassword === $confirmPassword) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update password in the database
            $updateSql = "UPDATE student SET password = ? WHERE student_username = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("ss", $hashedPassword, $student_username);
            $updateStmt->execute();
            $updateStmt->close();

            // Redirect to dashboard with success message
            header("Location: StudentDashboard.php?password_changed=1");
            exit();
        } else {
            // Redirect to dashboard with error message
            header("Location: StudentDashboard.php?error=password_mismatch");
            exit();
        }
    } else {
        // Redirect to dashboard with error message
        header("Location: StudentDashboard.php?error=current_password_incorrect");
        exit();
    }
}
?>
