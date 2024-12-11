<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Management</title>
    <!-- CSS Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Feedback Management</h1>
        <table>
            <thead>
                <tr>
                    <th>Feedback ID</th>
                    <th>Branch</th>
                    <th>Subject</th>
                    <th>Faculty</th>
                    <th>CSV</th>
                    <!-- Add more table headers as needed -->
                </tr>
            </thead>
            <tbody id="feedbackContainer"></tbody>
        </table>
    </div>

    <!-- JavaScript Code -->
    <script>
        // Function to fetch feedback data from the server
        function fetchFeedbackData() {
            fetch('fetch_feedback_forms.php') // Change to the correct URL
                .then(response => response.json())
                .then(data => {
                    // Display feedback data in the table
                    const feedbackContainer = document.getElementById('feedbackContainer');
                    feedbackContainer.innerHTML = ''; // Clear previous content
                    if (data.length > 0) {
                        data.forEach(feedback => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${feedback.id}</td>
                                <td>${feedback.branch_name}</td>
                                <td>${feedback.subject_name}</td>
                                <td>${feedback.faculty_name}</td>
                                <td><button onclick="viewCSV('${feedback.csv_file}')">View CSV</button></td>
                                <!-- Add more table data as needed -->
                            `;
                            feedbackContainer.appendChild(row);
                        });
                    } else {
                        const emptyRow = document.createElement('tr');
                        emptyRow.innerHTML = '<td colspan="5">No feedback forms found.</td>';
                        feedbackContainer.appendChild(emptyRow);
                    }
                })
                .catch(error => {
                    console.error('Error fetching feedback:', error);
                });
        }

        // Function to view CSV data
        function viewCSV(csvFileName) {
            fetch(csvFileName) // Fetch the CSV file
                .then(response => response.text())
                .then(data => {
                    // Parse CSV data and display in tabular form
                    const csvRows = data.split('\n');
                    const headers = csvRows[0].split(',');
                    const table = document.createElement('table');
                    // Create table headers
                    const headerRow = document.createElement('tr');
                    headers.forEach(headerText => {
                        const th = document.createElement('th');
                        th.textContent = headerText;
                        headerRow.appendChild(th);
                    });
                    table.appendChild(headerRow);
                    // Create table rows
                    for (let i = 1; i < csvRows.length; i++) {
                        const rowData = csvRows[i].split(',');
                        if (rowData.length === headers.length) {
                            const row = document.createElement('tr');
                            rowData.forEach(cellData => {
                                const td = document.createElement('td');
                                td.textContent = cellData;
                                row.appendChild(td);
                            });
                            table.appendChild(row);
                        }
                    }
                    // Display CSV table below the main table
                    document.getElementById('feedbackContainer').insertAdjacentElement('afterend', table);
                })
                .catch(error => {
                    console.error('Error fetching CSV:', error);
                });
        }

        // Fetch feedback data when the page loads
        window.onload = function () {
            fetchFeedbackData();
        };
    </script>
</body>

</html>
