<?php
include('header.php');
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "students_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all students
$sql = "SELECT student_name, student_id, gpa, credit_hours, age FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Students</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">
</head>
<body>

    <header class="bg-primary text-white py-3">
        <nav>
            <ul class="nav justify-content-center">
                <li class="nav-item"><a href="dashboard.php" class="nav-link text-white">Dashboard</a></li>
                <li class="nav-item"><a href="student-registration.php" class="nav-link text-white">Register Students</a></li>
                <li class="nav-item"><a href="ContactUs.php" class="nav-link text-white">Contact Us</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="py-5">
        <div class="container">
            <section class="list-students">
                <h2 class="text-center mb-4">Registered Students</h2>
                <p class="text-center mb-4">Below is the list of all registered students in the system.</p>

                <!-- Student List Table -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>GPA</th>
                            <th>Credit Hours</th>
                            <th>Age</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . htmlspecialchars($row['student_name']) . "</td>
                                    <td>" . htmlspecialchars($row['student_id']) . "</td>
                                    <td>" . number_format($row['gpa'], 2) . "</td>
                                    <td>" . htmlspecialchars($row['credit_hours']) . "</td>
                                    <td>" . htmlspecialchars($row['age']) . "</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No students found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>Student Management System</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
