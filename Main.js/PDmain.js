function searchByFacultyName() {
  var facultyName = document.getElementById("facultyName").value;
  // Here you can add your logic to handle the search functionality by faculty name
  alert("Searching for Faculty Name: " + facultyName);
}

function displayTable() {
  var tableContainer = document.getElementById("table-container");
  tableContainer.style.display = "block"; // Display the table container

  // Get the values from the form
  var branch = document.getElementById("branch").value;
  var year = document.getElementById("year").value;
  var semester = document.getElementById("semester").value;

  // Populate the table with data
  var tbody = document.querySelector("#result-table tbody");
  var newRow = tbody.insertRow();
  var cell1 = newRow.insertCell(0);
  var cell2 = newRow.insertCell(1);
  var cell3 = newRow.insertCell(2);
  var cell4 = newRow.insertCell(3);
  cell1.textContent = branch;
  cell2.textContent = year;
  cell3.textContent = semester;
  cell4.innerHTML = '<button onclick="performAction()">Action</button>';
  // Add more rows and data as needed
}

function performAction() {
  // Define the action to be performed here
  alert("Performing action...");
}
