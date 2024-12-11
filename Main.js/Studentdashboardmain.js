// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

// Close menu when clicking outside on mobile devices
document.addEventListener("click", function(event) {
    if (!event.target.closest('.toggle') && !event.target.closest('.navigation')) {
        navigation.classList.remove("active");
        main.classList.remove("active");
    }
});

// Function to display student details
async function displayStudentDetails() {
    try {
        // Fetch student details from database
        const response = await fetch('fetch_student_details.php'); // Replace 'fetch_student_details.php' with your actual endpoint
        const studentDetails = await response.json();

        // Construct HTML to display student details
        var detailsHTML = `
            <table>
                <tr>
                    <td>Name:</td>
                    <td>${studentDetails.name}</td>
                </tr>
                <tr>
                    <td>Roll Number:</td>
                    <td>${studentDetails.rollnumber}</td>
                </tr>
                <tr>
                    <td>Branch:</td>
                    <td>${studentDetails.branch}</td>
                </tr>
                <tr>
                    <td>Regulation:</td>
                    <td>${studentDetails.regulation}</td>
                </tr>
                <tr>
                    <td>Batch:</td>
                    <td>${studentDetails.batch}</td>
                </tr>
                <tr>
                    <td>Year:</td>
                    <td>${studentDetails.year}</td>
                </tr>
                <tr>
                    <td>Sem:</td>
                    <td>${studentDetails.semester}</td>
                </tr>
            </table>
        `;

        // Get a reference to the div where details will be displayed
        var studentDetailsDiv = document.getElementById('studentDetails');

        // Set the HTML content of the div to the detailsHTML
        studentDetailsDiv.innerHTML = detailsHTML;

        // Show the student details container
        studentDetailsDiv.style.display = 'block';

        // Close the navigation menu if it's open (for mobile responsiveness)
        navigation.classList.remove('active');
        main.classList.remove('active');
    } catch (error) {
        console.error('Error fetching student details:', error);
    }
}

// Get a reference to the "Student Profile" link
var studentProfileLink = document.getElementById('studentProfileLink');

// Add a click event listener to the link
studentProfileLink.addEventListener('click', function(event) {
    // Prevent the default action (e.g., following the link)
    event.preventDefault();

    // Call the function to display student details
    displayStudentDetails();
});
