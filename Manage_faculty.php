<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/feedback_managment.css">
    <title>Faculty Management</title>
</head>
<body>
    <div class="Wrapper">
        <div class="container">
            <h1>Faculty Management</h1>
            <!-- Dropdown menu for departments -->
            <select id="departmentSelect">
                <option value="">Select Department</option>
                <?php
                // Include the database connection file
                include 'db_connect.php';

                // Fetch departments from the database
                $departmentSql = "SELECT * FROM Departments";
                $departmentResult = $conn->query($departmentSql);
                while ($row = $departmentResult->fetch_assoc()) {
                    echo "<option value='" . $row['department_id'] . "'>" . $row['name'] . "</option>";
                }

                // Close database connection
                $conn->close();
                ?>
            </select>

            <!-- Faculty table -->
            <form id="facultyForm">
                <table border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th> <!-- Added Phone column -->
                            <!-- Add other fields here -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="facultyTableBody">
                        <!-- Faculty members will be inserted here dynamically -->
                    </tbody>
                </table>
            </form>
            
            <div class="btn-container">
                <a href="add_faculty.php" class="btn">Add Faculty</a>
                <a href="admin_dashboard.php" class="btn">Go to admin-dashboard</a>
                <a href="index.php" class="btn">Go to Home Page</a>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to fetch faculty members based on selected department
            $('#departmentSelect').change(function() {
                var departmentId = $(this).val();
                if (departmentId !== '') {
                    $.ajax({
                        type: 'POST',
                        url: 'get_faculty.php',
                        data: { department_id: departmentId },
                        success: function(response) {
                            $('#facultyTableBody').html(response);
                        }
                    });
                }
            });

            // Function to handle form submission for updating faculty members
            $(document).on('submit', '#facultyForm', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'update_faculty.php',
                    data: formData,
                    success: function(response) {
                        $('#facultyTableBody').html(response);
                    }
                });
            });

            // Function to handle delete action
            $(document).on('click', 'input[name="delete"]', function() {
                var id = $(this).closest('tr').find('input[name="id"]').val();
                if (confirm("Are you sure you want to delete this faculty member?")) {
                    $.ajax({
                        type: 'POST',
                        url: 'delete_faculty.php',
                        data: { id: id },
                        success: function(response) {
                            $('#facultyTableBody').html(response);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
