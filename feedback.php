<?php
session_start(); // Start the session

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['student_username'])) {
    header("Location: index.php"); // Redirect to login page
    exit();
}

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

// Function to fetch all questions from the Question table
function getAllQuestions($conn) {
    $sql = "SELECT * FROM Question";
    $result = $conn->query($sql);
    return $result;
}

// Fetch all questions
$questionsResult = getAllQuestions($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/feedback.css">
    <title>Feedback Form</title>
</head>
<body>
    <div class="container">
        <h2>Faculty Feedback Form</h2>
        <form action="submit_feedback.php" method="post">
            <label for="faculty_name">Faculty Name:</label><br>
            <input type="text" id="faculty_name" name="faculty_name" required><br><br>

            <label for="subject">Subject:</label><br>
            <input type="text" id="subject" name="subject" placeholder="" required><br><br>

            <!-- Loop through questions and create dropdowns -->
            <?php
            if ($questionsResult->num_rows > 0) {
                $questionNumber = 1;
                while ($row = $questionsResult->fetch_assoc()) {
                    echo "<label for='question$questionNumber'>Question $questionNumber: {$row['question_text']}</label><br>";
                    echo "<select id='question$questionNumber' name='question$questionNumber' required>";
                    echo "<option value=''>Select</option>";
                    echo "<option value='excellent'>Excellent</option>";
                    echo "<option value='good'>Good</option>";
                    echo "<option value='average'>Average</option>";
                    echo "<option value='poor'>Poor</option>";
                    echo "</select><br><br>";
                    $questionNumber++;
                }
            }
            ?>

            <label for="comments">Additional Comments or Suggestions:</label><br>
            <textarea id="comments" name="comments" rows="4" cols="50"></textarea><br><br>
            <input type="submit" value="Submit Feedback">

            <!-- Button to go to home page -->
            <a href="index.php" class="button">Go to Home</a>
            <!-- Button to go to student dashboard -->
            <a href="student_dashboard.php" class="button">Student Dashboard</a>
        </form>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
