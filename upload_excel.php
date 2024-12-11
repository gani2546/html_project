<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted with Excel file
    if (isset($_FILES['excel_file'])) {
        $file = $_FILES['excel_file']['tmp_name'];
        $file_name = $_FILES['excel_file']['name'];
        
        // Check if file is an Excel file
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if ($file_ext === 'xlsx' || $file_ext === 'xls') {
            // Open the Excel file for reading
            $handle = fopen($file, "r");
            
            // Include database connection code here
            include 'db_connect.php';
            
            // Initialize a variable to track empty fields
            $empty_fields = false;
            
            // Loop through each row of the Excel file
            while (($rowData = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Skip the header row
                if ($rowData[0] == 'Name' && $rowData[1] == 'Department') {
                    continue;
                }
                
                // Check if required fields are not empty
                if (!empty($rowData[0]) && !empty($rowData[1])) {
                    // Sanitize input data if necessary
                    $name = $rowData[0];
                    $department = $rowData[1];
                    
                    // Prepare and execute SQL statement to insert data into the database
                    $sql = "INSERT INTO faculty (name, department) VALUES (?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $name, $department);

                    if ($stmt->execute()) {
                        // Data inserted successfully
                        // You can add any additional logic here if needed
                    } else {
                        // If an error occurs, you may log it or handle it as needed
                        echo "Error: " . $stmt->error;
                    }

                    // Close the statement
                    $stmt->close();
                } else {
                    // Set flag if empty fields are detected
                    $empty_fields = true;
                }
            }
            
            // Close the Excel file handle
            fclose($handle);
            
            // Close the database connection
            $conn->close();
            
            // Check if any empty fields were detected
            if ($empty_fields) {
                echo "Error: Empty fields detected.";
            } else {
                // Redirect with success message after all data is inserted
                header("Location: add_faculty.php?success=true");
                exit();
            }
        } else {
            echo "Invalid file format. Please upload an Excel file.";
        }
    }
}
?>
