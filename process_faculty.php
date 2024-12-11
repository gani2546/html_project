<?php
// Database connection
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $facultyName = $_POST['faculty_name'];
    $facultyEmail = $_POST['faculty_email'];
    $facultyPhone = $_POST['faculty_phone'];
    $departmentName = $_POST['department'];
    $subjectName = $_POST['subject'];

    // Insert faculty data into Faculties table
    $insertFacultyQuery = "INSERT INTO Faculties (name, email, phone) VALUES ('$facultyName', '$facultyEmail', '$facultyPhone')";
    if (mysqli_query($conn, $insertFacultyQuery)) {
        // Insert faculty department relationship into Faculty_Departments table
        $insertFacultyDepartmentQuery = "INSERT INTO Faculty_Departments (faculty_name, department_name) VALUES ('$facultyName', '$departmentName')";
        mysqli_query($conn, $insertFacultyDepartmentQuery);

        // Insert faculty subject relationship into Faculty_Subjects table
        $insertFacultySubjectQuery = "INSERT INTO Faculty_Subjects (faculty_name, subject_name) VALUES ('$facultyName', '$subjectName')";
        mysqli_query($conn, $insertFacultySubjectQuery);

        echo "Faculty added successfully.";
    } else {
        echo "Error: " . $insertFacultyQuery . "<br>" . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>
