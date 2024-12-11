<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add_faculty.css">
    <title>Add Faculty</title>
</head>
<body>
    <div class="container">
        <h1>Add Faculty</h1>
        <form id="add_faculty_form">
            <label for="faculty_name">Faculty Name:</label>
            <input type="text" id="faculty_name" name="faculty_name" required>

            <label for="faculty_email">Email:</label>
            <input type="email" id="faculty_email" name="faculty_email" required>

            <label for="faculty_phone">Phone:</label>
            <input type="tel" id="faculty_phone" name="faculty_phone" required>

            <label for="department_select">Department:</label>
            <select id="department_select" name="department" required>
                <option value="">Select Department</option>
                <!-- Departments will be fetched dynamically using AJAX -->
            </select>

            <label for="subject_select">Subject:</label>
            <select id="subject_select" name="subject" required>
                <option value="">Select Subject</option>
                <!-- Subjects will be fetched dynamically using AJAX -->
            </select>

            <input type="submit" value="Add Faculty">
        </form>
        
        <div class="btn-container">
            <a href="Manage_Faculty.php">Manage Faculty</a>
            <a href="admin_dashboard.php">Admin Dashboard</a>
            <a href="index.php">Go to Home Page</a>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
$(document).ready(function() {
    // Fetch departments from the server
    $.ajax({
        type: 'POST',
        url: 'fetch_departments.php',
        success: function(response) {
            $('#department_select').html(response);
        }
    });

    // Update subjects based on selected department
    $('#department_select').change(function() {
        var departmentName = $(this).val(); // Get selected department name
        $.ajax({
            type: 'POST',
            url: 'fetch_subjects.php',
            data: { department_name: departmentName }, // Send department name
            success: function(response) {
                $('#subject_select').html(response);
            }
        });
    });

    // Handle form submission
    $('#add_faculty_form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission
        var formData = $(this).serialize(); // Get form data
        $.ajax({
            type: 'POST',
            url: 'process_faculty.php',
            data: formData,
            success: function(response) {
                alert(response); // Show response message
                location.reload(); // Refresh the page after adding faculty
            }
        });
    });
});

    </script>
</body>
</html>
