<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Delete the faculty member from Faculty_Departments table
    $deleteFacultyDepartmentsSql = "DELETE FROM Faculty_Departments WHERE faculty_id = $id";
    $conn->query($deleteFacultyDepartmentsSql);

    // Delete the faculty member from Faculty_Subjects table
    $deleteFacultySubjectsSql = "DELETE FROM Faculty_Subjects WHERE faculty_id = $id";
    $conn->query($deleteFacultySubjectsSql);

    // Delete the faculty member from Faculties table
    $deleteFacultySql = "DELETE FROM Faculties WHERE faculty_id = $id";
    if ($conn->query($deleteFacultySql) === TRUE) {
        echo "<tr><td colspan='5'>Faculty member deleted successfully.</td></tr>";
    } else {
        echo "<tr><td colspan='5'>Error deleting faculty member: " . $conn->error . "</td></tr>";
    }
}
?>
