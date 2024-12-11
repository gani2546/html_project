<?php
include 'db_connect.php';

// Check if department ID is provided
if (isset($_POST['department_id'])) {
    $departmentId = $_POST['department_id'];

    // Query to fetch faculty members based on department
    $sql = "SELECT f.*, f.phone FROM Faculties f 
            INNER JOIN Faculty_Departments fd ON f.faculty_id = fd.faculty_id 
            WHERE fd.department_id = $departmentId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $output = '';
        $idCounter = 1;
        while ($row = $result->fetch_assoc()) {
            $output .= "<tr>";
            $output .= "<td>" . $idCounter . "</td>";
            $output .= "<td><input type='text' name='name' value='" . $row["name"] . "'></td>";
            $output .= "<td><input type='text' name='email' value='" . $row["email"] . "'></td>";
            $output .= "<td><input type='text' name='phone' value='" . $row["phone"] . "'></td>";
            // Add other fields here as needed
            $output .= "<td>";
            $output .= "<input type='hidden' name='id' value='" . $row["faculty_id"] . "'>";
            $output .= "<input type='submit' name='update' value='Update'>";
            $output .= "<input type='submit' name='delete' value='Delete'>";
            $output .= "</td>";
            $output .= "</tr>";
            $idCounter++;
        }
        echo $output;
    } else {
        echo "<tr><td colspan='5'>No faculty members available</td></tr>";
    }
}

$conn->close();
?>
