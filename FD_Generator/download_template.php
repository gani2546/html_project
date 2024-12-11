<?php
// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="questions.csv"');

// Open file handle
$output = fopen('php://output', 'w');

// CSV header
$header = array('Question', 'Question Text');

// Write header to CSV file
fputcsv($output, $header);

// Generate template questions
for ($i = 1; $i <= 10; $i++) {
    $row = array("Question $i", "");
    fputcsv($output, $row);
}

// Close file handle
fclose($output);
?>
