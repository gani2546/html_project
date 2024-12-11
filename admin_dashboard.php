<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- ======= Styles ======= -->
    <link rel="stylesheet" href="css/AdminDashboard.css">
    <style>
        /* Ensure the iframe fills its container */
        #feedback iframe {
            width: 100%;
            height: 100%;
            border: none; /* Remove iframe border */
        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="title">ADMIN DASHBOARD</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="toggleModule('home')">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">HOME</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="toggleModule('feedback')">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Feedback Management</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="toggleModule('questions')">
                        <span class="icon">
                            <ion-icon name="create-outline"></ion-icon>
                        </span>
                        <span class="title">Question Management</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="toggleModule('reports')">
                        <span class="icon">
                            <ion-icon name="clipboard-outline"></ion-icon>
                        </span>
                        <span class="title">Feedback Reports</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="toggleModule('faculty')">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Faculty and subjects</span>
                    </a>
                </li>
                <li>
                    <a href="Adminlogout.php">
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

            <!-- Feedback Management iframe -->
            <div id="feedback" class="module" style="display:X-large;">
                <iframe id="feedbackIframe" src="feedback_managment.php"></iframe>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="Main.js/AdminDashboardmain.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        function toggleModule(moduleName) {
            var module = document.getElementById(moduleName);
            module.style.display = (module.style.display === "block") ? "none" : "block";

            if (moduleName === 'feedback') {
                var iframe = document.getElementById('feedbackIframe');
                iframe.onload = function() {
                    var height = iframe.contentWindow.document.body.scrollHeight + 'px';
                    iframe.style.height = height;
                };
            }
        }
    </script>
</body>

</html>
