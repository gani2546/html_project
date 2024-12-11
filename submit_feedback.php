<?php
session_start(); // Start the session

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['student_username'])) {
    header("Location: index.php"); // Redirect to login page
    exit();
}

// Include the database connection file
include 'db_connect.php';

// Retrieve form data
$faculty_name = $_POST['faculty_name'];
$subject = $_POST['subject'];

// Prepare and execute SQL statement to get faculty ID from faculty name
$sql_faculty_id = "SELECT id FROM faculty WHERE name = ?";
$stmt_faculty_id = $conn->prepare($sql_faculty_id);
$stmt_faculty_id->bind_param("s", $faculty_name);
$stmt_faculty_id->execute();
$result_faculty_id = $stmt_faculty_id->get_result();

// Check if the faculty exists
if ($result_faculty_id->num_rows > 0) {
    $row_faculty_id = $result_faculty_id->fetch_assoc();
    $faculty_id = $row_faculty_id['id'];

    // Initialize an array to store question responses
    $questions = array();
    for ($i = 1; $i <= 4; $i++) {
        // Check if the question is set in the form data
        if (isset($_POST["question$i"])) {
            $questions[] = $_POST["question$i"];
        } else {
            // If the question is not set, assume default value
            $questions[] = 'N/A';
        }
    }

    // Retrieve comments
    $comments = $_POST['comments'];

    // Prepare and execute SQL statement to insert feedback into the database
    $sql_insert_feedback = "INSERT INTO feedback (faculty_id, subject, question1, question2, question3, question4, comments) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert_feedback = $conn->prepare($sql_insert_feedback);
    $stmt_insert_feedback->bind_param("issssss", $faculty_id, $subject, $questions[0], $questions[1], $questions[2], $questions[3], $comments);
    $stmt_insert_feedback->execute();
    $stmt_insert_feedback->close();

    // Redirect back to feedback form with success message
    header("Location: feedback.php?success=true");
    exit();
} else {
    // If faculty does not exist, redirect back to feedback form with error message
    header("Location: feedback.php?error=faculty_not_found");
    exit();
}

?>
