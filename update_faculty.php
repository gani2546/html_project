<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Update faculty record
    $updateSql = "UPDATE Faculties SET name = '$name', email = '$email', phone = '$phone' WHERE faculty_id = $id";
    $conn->query($updateSql);

    // Handle updates in related tables if necessary

    // Fetch updated faculty table HTML markup
    include 'get_faculty.php';
}
?>
