<?php
session_start(); // Start session if not started already

// Database configuration
$servername = "localhost"; // Change this if your MySQL server is hosted on a different machine
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "user_authentication"; // Change this to the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch departments from the database
function getDepartments($conn) {
    $output = "";
    $departmentsResult = $conn->query("SELECT DISTINCT Department FROM Subject_Questions");
    if ($departmentsResult->num_rows > 0) {
        $output = "<option value=''>Select Department</option>";
        while ($row = $departmentsResult->fetch_assoc()) {
            $output .= "<option value='" . $row["Department"] . "'>" . $row["Department"] . "</option>";
        }
    }
    echo $output;
}

// Function to fetch subjects for a selected department
function getSubjectsForDepartment($conn, $departmentName) {
    $stmt = $conn->prepare("SELECT DISTINCT Subject FROM Subject_Questions WHERE Department = ?");
    $stmt->bind_param("s", $departmentName);
    $stmt->execute();
    $subjectsResult = $stmt->get_result();

    if ($subjectsResult->num_rows > 0) {
        $output = "<option value=''>Select Subject</option>";
        while ($row = $subjectsResult->fetch_assoc()) {
            $output .= "<option value='" . $row["Subject"] . "'>" . $row["Subject"] . "</option>";
        }
        echo $output;
    } else {
        echo "<option value=''>No subjects available for the selected department</option>";
    }
}

// Function to fetch all questions for a selected subject
function getQuestionsForSubject($conn, $subjectName) {
    $stmt = $conn->prepare("SELECT * FROM Subject_Questions WHERE Subject = ?");
    $stmt->bind_param("s", $subjectName);
    $stmt->execute();
    $questionsResult = $stmt->get_result();

    if ($questionsResult->num_rows > 0) {
        $output = "<h2>Questions for Selected Subject</h2>";
        $output .= "<table border='1'>";
        $output .= "<tr><th>Question</th><th>Action</th></tr>";
        while ($row = $questionsResult->fetch_assoc()) {
            $output .= "<tr>";
            $output .= "<td>" . $row["Question_text"] . "</td>";
            $output .= "<td>";
            $output .= "<form class='question_form' action='ajax_handler.php' method='post'>";
            $output .= "<input type='hidden' name='id' value='" . $row["id"] . "'>"; // Add id field here
            $output .= "<input type='hidden' name='action' value='update'>";
            $output .= "<input type='text' name='question' value='" . $row["Question_text"] . "'>";
            $output .= "<button type='submit' name='update'>Update</button>";
            $output .= "<button type='submit' name='delete'>Delete</button>";
            $output .= "</form>";
            $output .= "</td>";
            $output .= "</tr>";
        }
        $output .= "</table>";
        echo $output;
    } else {
        echo "<p>No questions available for the selected subject.</p>";
    }
}

// Function to insert a new question
function insertQuestion($conn, $questionText, $subjectName, $departmentName) {
    $stmt = $conn->prepare("INSERT INTO Subject_Questions (Department, Subject, Question_text) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $departmentName, $subjectName, $questionText);
    $stmt->execute();
    $stmt->close();
}

// Function to update a question
function updateQuestion($conn, $questionId, $questionText) {
    $stmt = $conn->prepare("UPDATE Subject_Questions SET Question_text = ? WHERE id = ?");
    $stmt->bind_param("si", $questionText, $questionId);
    $stmt->execute();
    $stmt->close();
}

// Function to delete a question
function deleteQuestion($conn, $questionId) {
    $stmt = $conn->prepare("DELETE FROM Subject_Questions WHERE id = ?");
    $stmt->bind_param("i", $questionId);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "Question deleted successfully.";
    } else {
        echo "Error: Failed to delete question.";
    }
    $stmt->close();
}

// Handle AJAX requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get departments for dropdown
    if (isset($_POST['get_departments'])) {
        getDepartments($conn);
    }

    // Fetch subjects for the selected department
    if (isset($_POST['department'])) {
        $selectedDepartmentName = $_POST['department'];
        getSubjectsForDepartment($conn, $selectedDepartmentName);
    }

    // Fetch questions for the selected subject
    if (isset($_POST['subject'])) {
        $selectedSubjectName = $_POST['subject'];
        getQuestionsForSubject($conn, $selectedSubjectName);
    }

    // Insert a new question
    if (isset($_POST['action']) && $_POST['action'] == 'insert') {
        $newQuestionText = $_POST['new_question'];
        $subjectName = $_POST['subject'];
        $departmentName = $_POST['department']; // Explicitly pass department value
        insertQuestion($conn, $newQuestionText, $subjectName, $departmentName);
        getQuestionsForSubject($conn, $subjectName); // Refresh questions after insertion
    }

    // Update a question
    if (isset($_POST['action']) && $_POST['action'] == 'update') {
        $questionId = $_POST['id'];
        $updatedQuestionText = $_POST['question'];
        updateQuestion($conn, $questionId, $updatedQuestionText);
        if (isset($_POST['subject'])) { // Check if 'subject' is set before accessing its value
            $selectedSubjectName = $_POST['subject'];
            getQuestionsForSubject($conn, $selectedSubjectName); // Refresh questions after update
        }
    }

    // Delete a question
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $questionId = $_POST['id'];
        deleteQuestion($conn, $questionId);
        if (isset($_POST['subject'])) { // Check if 'subject' is set before accessing its value
            $selectedSubjectName = $_POST['subject'];
            getQuestionsForSubject($conn, $selectedSubjectName); // Refresh questions after deletion
        }
    }
}

// Close connection
$conn->close();
?>
