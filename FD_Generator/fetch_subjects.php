<?php

// Placeholder code to fetch subjects based on branch from the database
// Replace this with your actual database query

$branchId = $_GET['branch_id']; // Retrieve branch id from query string

// Example subjects for each branch (you need to replace this with your actual data)
$subjects = [
    ['id' => 1, 'name' => 'Engineering Mechanics'],
    ['id' => 2, 'name' => 'Structural Analysis'],
    ['id' => 3, 'name' => 'Fluid Mechanics'],
    ['id' => 4, 'name' => 'Geotechnical Engineering'],
    ['id' => 5, 'name' => 'Transportation Engineering'],
];

echo json_encode($subjects);
