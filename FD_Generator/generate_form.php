<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form Generator</title>
    <link rel="stylesheet" href="css/FD_generator.css">
</head>
<body>

    <!-- Manual question entry -->
    <div class="Manualcontainer">
        <h2>Enter Questions Manually</h2>
        <form id="manualQuestionsForm">
            <table id="manualQuestionsTable">
                <thead>
                    <tr>
                        <th>Question ID</th>
                        <th>Question Text</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows will be dynamically added here -->
                </tbody>
            </table>
        </form>
        <button id="submitManualBtn">Submit Manual Questions</button>
    </div>

    <!-- Bulk question entry -->
    <div class="Bulkcontainer">
        <h2>Bulk Question Entry</h2>
        <p>Download the CSV template to enter questions in bulk:</p>
        <a href="download_template.php" download>Download CSV Template</a>
        <br><br>
        <form id="csvUploadForm" enctype="multipart/form-data">
            <label for="csvFile">Upload CSV file with questions:</label>
            <input type="file" id="csvFile" name="csvFile">
            <button type="submit" id="uploadBtn">Upload CSV</button>
        </form>
    </div>

    <script src="JsScript/Fdgscripts.js"></script>
    <script>
        // Function to add rows to the manualQuestionsTable
        function addRow(questionId) {
            var table = document.getElementById("manualQuestionsTable").getElementsByTagName('tbody')[0];
            var newRow = table.insertRow();
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            cell1.innerHTML = "Question " + questionId;
            cell2.innerHTML = '<input type="text" id="question' + questionId + '" name="question' + questionId + '" placeholder="Enter question ' + questionId + '">';
        }

        // Add 10 initial rows
        for (var i = 1; i <= 10; i++) {
            addRow(i);
        }
    </script>
</body>
</html>
