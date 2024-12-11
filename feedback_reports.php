<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_authentication";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch feedback data from the database

// Function to fetch all feedback along with faculty information
function getAllFeedback() {
    global $conn;
    $sql = "SELECT f.*, fac.name AS faculty_name, fac.subject AS faculty_subject
            FROM feedback f
            INNER JOIN faculty fac ON f.faculty_id = fac.id";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error fetching feedback: " . $conn->error);
    }
    return $result;
}

// Fetch all feedback along with faculty information
$feedbackResult = getAllFeedback();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/feedback_reports.css">
    <title>Feedback Reports</title>
</head>
<body>
    <div class="Wrapper">
        <div class="container">
            
            <header>
                <img src="css/ideal logo.jpg" alt="Company Logo" class="logo">
            </header>
            <h1 style="text-align: center;">Feedback Reports</h1>

            <!-- Print Button -->
            <button onclick="window.print()">Print</button>

            <!-- Display Feedback -->
            <h2>All Feedback</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Faculty Name</th>
                    <th>Faculty Subject</th>
                    <th>Subject</th>
                    <th>Question 1</th>
                    <th>Question 2</th>
                    <th>Question 3</th>
                    <th>Question 4</th>
                    <th>Comments</th>
                    <th>Created At</th>
                </tr>
                <?php
                if ($feedbackResult->num_rows > 0) {
                    while ($row = $feedbackResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["faculty_name"] . "</td>";
                        echo "<td>" . $row["faculty_subject"] . "</td>";
                        echo "<td>" . $row["subject"] . "</td>";
                        echo "<td>" . $row["question1"] . "</td>";
                        echo "<td>" . $row["question2"] . "</td>";
                        echo "<td>" . $row["question3"] . "</td>";
                        echo "<td>" . $row["question4"] . "</td>";
                        echo "<td>" . $row["comments"] . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No feedback available</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>    
</body>
</html>
