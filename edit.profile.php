<?php
include("db_connect.php");
session_start(); // Start the session

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['student_username'])) {
    header("Location: index.php"); // Redirect to login page
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the updated details from the form
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $program = $_POST['program'];
    $year = $_POST['year'];
    $sem = $_POST['Sem'];
    
    // Establish connection to the database
    $connection = new mysqli("localhost", "root", "", "user_authentication");

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare the SQL statement to update the student's details
    $sql = "UPDATE student SET Name=?, program=?, year=?, sem=? WHERE student_username=?";

    // Prepare and bind parameters
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssss", $name, $program, $year, $sem, $_SESSION['student_username']);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Profile updated successfully.";
    } else {
        echo "Failed to update profile.";
    }

    // Close statement and connection
    $stmt->close();
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/edit.profile.css">
    <title>Edit Profile</title>
</head>
<body>
    <form action="" method="POST">
        <h2>Edit Profile</h2>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars(''); ?>"><br>
        <label for="student_id">Student ID</label>
        <input type="text" id="student_id" name="student_id" value="<?php echo htmlspecialchars(''); ?>"><br>
        <label for="program">Program</label>
        <input type="text" id="program" name="program" value="<?php echo htmlspecialchars(''); ?>"><br>
        <label for="year">Year</label>
        <input type="text" id="year" name="year" value="<?php echo htmlspecialchars(''); ?>"><br>
        <label for="Sem">Sem</label>
        <input type="text" id="Sem" name="Sem" value="<?php echo htmlspecialchars(''); ?>"><br>
        <button type="submit" class="button">Save Changes</button>
    </form>
    <form action="upload_image.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <button type="submit" name="submit">Upload Image</button>
    </form>
</body>
</html>
