// scripts.js
window.onload = function() {
    fetchFeedbackData();
};

function fetchFeedbackData() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var feedbackData = JSON.parse(this.responseText);
            displayFeedbackTable(feedbackData);
        }
    };
    xhttp.open("GET", "fetch_feedback.php", true);
    xhttp.send();
}

function displayFeedbackTable(feedbackData) {
    var table = document.createElement("table");
    var header = table.createTHead();
    var headerRow = header.insertRow();
    var headers = ["ID", "Branch ID", "Subject ID", "Faculty ID", "CSV File"];
    headers.forEach(headerText => {
        var th = document.createElement("th");
        var text = document.createTextNode(headerText);
        th.appendChild(text);
        headerRow.appendChild(th);
    });

    var tbody = table.createTBody();
    feedbackData.forEach(feedback => {
        var row = tbody.insertRow();
        var values = [feedback.id, feedback.branch_id, feedback.subject_id, feedback.faculty_id, feedback.csv_file];
        values.forEach(value => {
            var cell = row.insertCell();
            cell.appendChild(document.createTextNode(value));
        });
    });

    document.getElementById("feedbackTable").appendChild(table);
}
