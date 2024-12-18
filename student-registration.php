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

// Handle student registration, removal, and update
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

    if (isset($_POST['updateStudentId'])) {
        // Update student info logic
        $update_student_id = $_POST['updateStudentId'];
        $update_name = $_POST['updateStudentName'];
        $update_gpa = $_POST['updateGPA'];
        $update_credit_hours = $_POST['updateCreditHours'];
        $update_age = $_POST['updateAge'];

        // Build dynamic SQL query for updating fields
        $fields = [];
        $params = [];
        $types = "";

        if (!empty($update_name)) {
            $fields[] = "student_name = ?";
            $params[] = $update_name;
            $types .= "s";
        }
        if (!empty($update_gpa)) {
            $fields[] = "gpa = ?";
            $params[] = $update_gpa;
            $types .= "d";
        }
        if (!empty($update_credit_hours)) {
            $fields[] = "credit_hours = ?";
            $params[] = $update_credit_hours;
            $types .= "i";
        }
        if (!empty($update_age)) {
            $fields[] = "age = ?";
            $params[] = $update_age;
            $types .= "i";
        }

        if (!empty($fields)) {
            $sql = "UPDATE students SET " . implode(", ", $fields) . " WHERE student_id = ?";
            $params[] = $update_student_id;
            $types .= "i";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param($types, ...$params);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "<div class='alert alert-success'>Student information updated successfully.</div>";
                } else {
                    echo "<div class='alert alert-warning'>No changes were made or student not found.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='alert alert-warning'>No fields were provided to update.</div>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register, Remove, or Update Students</title>
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

            <!-- Update Student Info Section -->
            <section class="col-md-12 update-student py-5">
                <h2 class="text-center mb-4">Update Student Information</h2>
                <p class="text-center mb-4">Enter the student ID and the fields you want to update.</p>
                <form action="student-registration.php" method="post">
                    <div class="form-group">
                        <label for="updateStudentId">Student ID</label>
                        <input type="number" class="form-control" id="updateStudentId" name="updateStudentId" required placeholder="Enter Student ID">
                    </div>

                    <div class="form-group">
                        <label for="updateStudentName">Student Name</label>
                        <input type="text" class="form-control" id="updateStudentName" name="updateStudentName" placeholder="Enter New Student Name">
                    </div>

                    <div class="form-group">
                        <label for="updateGPA">Student GPA</label>
                        <input type="number" class="form-control" id="updateGPA" name="updateGPA" placeholder="Enter New GPA" min="0.0" max="4.0" step="0.1">
                    </div>

                    <div class="form-group">
                        <label for="updateCreditHours">Student Credit Hours</label>
                        <input type="number" class="form-control" id="updateCreditHours" name="updateCreditHours" placeholder="Enter New Credit Hours" step="1" min="0" max="144">
                    </div>

                    <div class="form-group">
                        <label for="updateAge">Student Age</label>
                        <input type="number" class="form-control" id="updateAge" name="updateAge" placeholder="Enter New Age" min="18">
                    </div>

                    <button type="submit" class="btn btn-warning btn-block">Update Student</button>
                </form>
            </section>
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
