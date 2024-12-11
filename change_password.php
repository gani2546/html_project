<?php
session_start(); // Start the session

// Check if user is logged in
if (!isset($_SESSION['student_username'])) {
    header("Location: index.php"); // Redirect to login page
    exit();
}

// Include the database connection file
include 'db_connect.php';

// Initialize variables
$passwordError = $passwordSuccess = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if new password and confirm password match
    if ($newPassword != $confirmPassword) {
        $passwordError = "New password and confirm password do not match.";
    } else {
        // Fetch student information from the database based on the student's username
        $student_username = $_SESSION['student_username'];
        $sql = "SELECT student_password FROM student WHERE student_username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $student_username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Verify current password
        if ($currentPassword != $row['student_password']) {
            $passwordError = "Current password is incorrect.";
        } else {
            // Update the password in the database
            $updateSql = "UPDATE student SET student_password = ? WHERE student_username = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("ss", $newPassword, $student_username);
            $updateStmt->execute();
            $updateStmt->close();

            $passwordSuccess = "Password updated successfully.";

            // Redirect to student_dashboard.php
            header("Location: student_dashboard.php");
            exit(); // Ensure script stops execution after redirection
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        /* CSS for the password change form wrapper */
        .password-wrapper {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Set wrapper height to full viewport height */
        }

        /* CSS for the form heading */
        .password-wrapper h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        /* CSS for the form fields */
        .password-wrapper label {
            margin-bottom: 8px;
        }

        .password-wrapper input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* CSS for the form submit button */
        .password-wrapper button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        /* CSS for the error message */
        .password-wrapper .error-message {
            color: red;
            margin-top: 10px;
            text-align: center;
        }

        /* CSS for the success message */
        .password-wrapper .success-message {
            color: green;
            margin-top: 10px;
            text-align: center;
        }

    </style>
</head>

<body>
    <!-- HTML form for changing password -->
    <div class="password-wrapper">
        <h2>Change Password</h2>
        <form id="changePasswordForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="currentPassword">Current Password:</label>
            <input type="password" id="currentPassword" name="currentPassword" required><br>

            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword" required><br>

            <label for="confirmPassword">Confirm New Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required><br>

            <button type="submit">Change Password</button>
        </form>

        <?php
        // Display password error or success message
        if (isset($passwordError)) {
            echo '<div class="error-message">' . $passwordError . '</div>';
        } elseif (isset($passwordSuccess)) {
            echo '<div class="success-message">' . $passwordSuccess . '</div>';
        }
        ?>
    </div>
</body>

</html>
