<?php
// Include header.php to handle session_start and other common logic
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">
</head>
<body>

    <header class="bg-primary text-white py-3">
        <nav>
            <ul class="nav justify-content-center">
                <li class="nav-item"><a href="./index.php" class="nav-link text-white">Home</a></li>
                <li class="nav-item"><a href="student-registration.php" class="nav-link text-white">Register Students</a></li>
                <li class="nav-item"><a href="list-students.php" class="nav-link text-white">List Students</a></li>
                <li class="nav-item"><a href="ContactUs.php" class="nav-link text-white">Contact Us</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard-overview py-5">
            <div class="container">
                <h2 class="text-center mb-4">Dashboard Overview</h2>
                <p class="text-center mb-4">Quick access to system stats and student data.</p>
            </div>
        </section>

        <section class="recent-activities py-5">
            <div class="container">
                <h2 class="text-center mb-4">Recent Activities</h2>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Check if there are activities in session
                        if (isset($_SESSION['activities']) && count($_SESSION['activities']) > 0) {
                            // Loop through activities and display them
                            foreach ($_SESSION['activities'] as $activity) {
                                echo "<tr>
                                        <td>" . htmlspecialchars($activity['timestamp']) . "</td>
                                        <td>" . htmlspecialchars($activity['page']) . "</td>
                                      </tr>";
                            }
                        } else {
                            // If no activities, show a placeholder
                            echo "<tr><td colspan='2' class='text-center'>No recent activities</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>Student Management System</p>
    </footer>

    <!-- Link to Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
