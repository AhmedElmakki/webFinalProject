<?php
// Start the session to check if the user is logged in
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
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

// Handle student registration and removal
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['StudentName']) && isset($_POST['studentId'])) {
        // Student registration logic
        $student_name = $_POST['StudentName'];
        $student_id = $_POST['studentId'];
        $gpa = $_POST['GPA'];
        $credit_hours = $_POST['CreditHours'];
        $age = $_POST['Age'];

        // Insert the student into the database
        $sql = "INSERT INTO students (student_name, student_id, gpa, credit_hours, age)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sidii", $student_name, $student_id, $gpa, $credit_hours, $age);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Student registered successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }

    if (isset($_POST['removeStudentId'])) {
        // Remove student logic
        $remove_student_id = $_POST['removeStudentId'];

        $sql = "DELETE FROM students WHERE student_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $remove_student_id);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "<div class='alert alert-success'>Student removed successfully.</div>";
            } else {
                echo "<div class='alert alert-warning'>No student found with that ID.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register or Remove Students</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">
</head>
<body>

    <header class="bg-primary text-white py-3">
        <nav>
            <ul class="nav justify-content-center">
                <li class="nav-item"><a href="dashboard.php" class="nav-link text-white">Dashboard</a></li>
                <li class="nav-item"><a href="list-students.php" class="nav-link text-white">List Students</a></li>
                <li class="nav-item"><a href="ContactUs.php" class="nav-link text-white">Contact Us</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="py-5">
        <div class="container">
            <div class="row">
                <!-- Student Registration Form Section -->
                <section class="col-md-6 student-registration">
                    <h2 class="text-center mb-4">Register a New Student</h2>
                    <p class="text-center mb-4">Please fill out the form below to register a new student.</p>

                    <form action="student-registration.php" method="post">
                        <div class="form-group">
                            <label for="StudentName">Student Name</label>
                            <input type="text" class="form-control" id="StudentName" name="StudentName" required placeholder="Enter Student Name">
                        </div>

                        <div class="form-group">
                            <label for="studentId">Student ID</label>
                            <input type="number" class="form-control" id="studentId" name="studentId" required placeholder="Enter Student ID">
                        </div>

                        <div class="form-group">
                             <label for="GPA">Student GPA</label>
                            <input type="number" class="form-control" id="GPA" name="GPA" required placeholder="Enter GPA" min="0.0" max="4.0" step="0.1">
                        </div>

                        <div class="form-group">
                            <label for="CreditHours">Student Credit Hours</label>
                            <input type="number" class="form-control" id="CreditHours" name="CreditHours" required placeholder="Enter Credit Hours" step="1" min="0" max="144">
                        </div>

                        <div class="form-group">
                            <label for="Age">Student Age</label>
                            <input type="number" class="form-control" id="Age" name="Age" required placeholder="Enter Age" min="18">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Register Student</button>
                    </form>
                </section>

                <!-- Remove Student Section -->
                <section class="col-md-6 remove-student py-5">
                    <h2 class="text-center mb-4">Remove Student</h2>
                    <p class="text-center mb-4">Enter the student ID to remove the student from the system.</p>
                    <form action="student-registration.php" method="post">
                        <div class="form-group">
                            <label for="removeStudentId">Student ID</label>
                            <input type="number" class="form-control" id="removeStudentId" name="removeStudentId" required placeholder="Enter Student ID">
                        </div>
                        <button type="submit" class="btn btn-danger btn-block">Remove Student</button>
                    </form>
                </section>
            </div>
        </div>
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
