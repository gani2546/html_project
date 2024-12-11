<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/Hod_dashboard.css">
<title>Hod Dashboard</title>
</head>
<body>
<div class="logo-container">
  <img class="logo" src="css/banner.jpg" alt="College Logo">
</div>

<div class="search-container">
    <input type="text" id="facultyName" class="search-input" placeholder="Enter Subject/Faculty Name">
    <button onclick="search()" class="search-button">Search</button>
</div>

<form id="searchForm">
  <div class="container">  
    <select id="branch" name="branch" class="dropdown branch">
      <option value="" disabled selected hidden>Branch</option>
      <option value="CSE">CSE</option>
      <option value="ECE">ECE</option>
    </select>
   
    <select id="year" name="year" class="dropdown">
      <option value="" disabled selected hidden>Year</option>
      <option value="IV YEAR">IV YEAR</option>
    </select>
    
    <select id="semester" name="semester" class="dropdown">
      <option value="" disabled selected hidden>Sem</option>
      <option value="Semester 1">Semester 1</option>
      <option value="Semester 2">Semester 2</option>
    </select>
    <button type="button" onclick="displayTable()" class="submit-button">Submit</button>
  </div>
</form>

<div id="table-container" style="display: none;">
  <table id="result-table" class="result-table">
    <thead>
      <tr>
        <th>Branch</th>
        <th>Year</th>
        <th>Semester</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- Table rows will be added dynamically -->
    </tbody>
  </table>
</div>
<div class="logout-container">
  <button onclick="logout()" class="logout-button">Logout</button>
</div>
<script src="Main.js/Hodmain.js"></script>
<script>
  function search() {
    var facultyName = document.getElementById('facultyName').value;
    var subject = document.getElementById('subject').value;
    // Perform search based on faculty name and subject
    // You can make an AJAX request to the server here to fetch search results
    // Update the table with the search results
  }

  function logout() {
    // Redirect to the logout page
    window.location.href = "Hodlogout.php";
  }
</script>

</body>
</html>
