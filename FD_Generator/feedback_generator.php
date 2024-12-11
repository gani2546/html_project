<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form Generator</title>
    <link rel="stylesheet" href="css/FD_generator.css">
</head>

<body>
    <div class="fdcontainer">
        <h1>Feedback Form Generator</h1>
        <label for="branch">Select Branch:</label>
        <select id="branch">
            <option value="">Select Branch</option>
        </select>
        <label for="subject">Select Subject:</label>
        <select id="subject">
            <option value="">Select Subject</option>
        </select>
        <label for="faculty">Select Faculty:</label>
        <select id="faculty">
            <option value="">Select Faculty</option>
        </select>
        <button id="generateFormBtn" onclick="generateForm()">Generate Form</button>
        <button id="submitFormBtn" class="hidden">Submit Form</button>
    </div>

    <div id="formContainer" class="container hidden">
        <h2>Feedback Form</h2>
        <form id="feedbackForm">
            <!-- Form fields will be generated dynamically using JavaScript -->
        </form>
    </div>

    <script src="JsScript/Fdgscripts.js"></script>

    <script>
        function generateForm() {
            // Generate form content dynamically here...

            // After generating the form content, toggle the questions module
            toggleModule('questions');
        }
    </script>
</body>

</html>
