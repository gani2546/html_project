<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate CSV file
    $questions = $_POST['questions'];
    $filename = 'feedback_questions.csv';
    $fp = fopen($filename, 'w');
    fputcsv($fp, $questions);
    fclose($fp);
    echo "CSV file generated successfully. <a href='upload_form.php'>Upload CSV</a>";
} else {
    echo "Error: Invalid request method";
}

?>
