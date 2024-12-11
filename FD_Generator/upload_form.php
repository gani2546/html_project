<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Feedback Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Upload Feedback Form</h2>
    <form id="uploadForm" method="post" action="submit_feedback.php" enctype="multipart/form-data">
        <label for="csvFile">Upload CSV file:</label>
        <input type="file" id="csvFile" name="csvFile"><br>

        <input type="submit" value="Upload CSV">
    </form>
</body>
</html>
