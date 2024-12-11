<?php
session_start(); // Start the session

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION['student_username'])) {
    header("Location: index.php"); // Redirect to login page
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/StudentDashBoard.css">
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="path/to/your/logo.png" alt="Logo">
        </div>
        <div class="navigation">
            <ul>
                <li>
                    <a href="#" onclick="showModule('Dashboard')">                   
                        <span class="title">STUDENT DASHBOARD</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="showModule('home')">
                        <span class="icon">
                            <ion-icon name="Home-outline"></ion-icon>
                        </span>
                        <span class="title">Home</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="showModule('studentProfile')">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Student Profile</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="showModule('changePassword')">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Change Password</span>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="showModule('feedback')">
                        <span class="icon">
                            <ion-icon name="file-tray-full-outline"></ion-icon>
                        </span>
                        <span class="title">Feedback</span>
                    </a>
                </li>

                <li>
                    <a href="Studentlogout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>
            <div class="logo">
                <img src="css/ideal.jpg" alt="Logo">
            </div>
            <div id="homeModule" class="module">
                <!-- Home module content -->
                <div class="wrapper-home">
                    <div class="welcome-box">
                        <h2 class="welcome-message">Welcome!
                           <h1> <?php echo $_SESSION['student_username']; ?></h1>
                        </h2>
                    </div>
                </div>
            </div>
            <div id="studentProfileModule" class="module" style="display: none;">
                <!-- Student profile module content -->
            </div>
            <div id="changePasswordModule" class="module" style="display: none;">
                <!-- Change password module content -->
                <div id="changePasswordFormContainer" style="display: none;"></div>
            </div>
            <div id="feedbackModule" class="module" style="display: none;">
                <!-- Feedback module content -->
            </div>
        </div>
    </div>
    <script src="Main.js/Studentdashboardmain.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        function showModule(moduleName) {
            // Hide all modules
            const modules = document.querySelectorAll('.module');
            modules.forEach(module => {
                module.style.display = 'none';
            });

            // Show the selected module
            const selectedModule = document.getElementById(moduleName + 'Module');
            selectedModule.style.display = 'block';

            // Fetch and display student details if Student Profile module is selected
            if (moduleName === 'studentProfile') {
                fetch('display_details.php')
                    .then(response => response.text())
                    .then(data => {
                        selectedModule.innerHTML = data;
                    })
                    .catch(error => {
                        console.error('Error fetching student details:', error);
                    });
            } else if (moduleName === 'home') {
                // Display welcome message in the home module
                const username = "<?php echo $_SESSION['student_username']; ?>"; // Fetch the username from the session
                selectedModule.innerHTML = `<h2>Welcome ${username}</h2>`;
            }

            // Load the change password form dynamically if Change Password module is selected
            if (moduleName === 'changePassword') {
                fetch('change_password.php')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('changePasswordFormContainer').innerHTML = data;
                        document.getElementById('changePasswordFormContainer').style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Error loading change password form:', error);
                    });
            } else {
                // Hide the change password form if another module is selected
                document.getElementById('changePasswordFormContainer').style.display = 'none';
            }
        }
    </script>
</body>

</html>
