<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/PD.css">
<title>Principal Dashboard</title>
</head>
<body>
<div class="logo-container">
  <img class="logo" src="css/banner.jpg" alt="College Logo">
</div>

<div class="search-container">
    <input type="text" id="facultyName" class="search-input" placeholder="Enter subject/Faculty Name">
    <button onclick="searchByFacultyName()" class="search-button">Search</button>
</div>

<form id="searchForm">
  <div class="container">  
    <select id="branch" name="branch" class="dropdown branch"> <!-- Add class "branch" -->
      <option value="" disabled selected hidden>Branch</option>
      <option value="CSE">CSE</option>
      <option value="ECE">ECE</option>
      <!-- Add more options as needed -->
    </select>
   
    <select id="year" name="year" class="dropdown">
      <option value="" disabled selected hidden>Year</option>
      <option value="IV YEAR">IV YEAR</option>
      <!-- Add more options as needed -->
    </select>
    
    <select id="semester" name="semester" class="dropdown">
      <option value="" disabled selected hidden>Sem</option>
      <option value="Semester 1">Semester 1</option>
      <option value="Semester 2">Semester 2</option>
      <!-- Add more options as needed -->
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
<script src="Main.js/PDmain.js"></script>
<script>
    function logout() {
    // Redirect to the logout page
    window.location.href = "Principallogout.php";
  }
</script>

</body>
</html>
