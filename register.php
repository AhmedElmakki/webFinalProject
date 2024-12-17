<?php
// Database connection
$servername = "localhost";  // Database server
$username = "root";         // Database username
$password = "";             // Database password (blank for localhost by default)
$dbname = "students_db";     // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $confirmPass = $_POST['confirmPassword'];

    // Validate form inputs
    if ($pass !== $confirmPass) {
        $error = "Passwords do not match!";
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        // Prepare and bind
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $user, $hashedPassword);

        // Execute query
        if ($stmt->execute()) {
            // Redirect to welcome page after successful registration
            header("Location: dashboard.php");
            exit();
        } else {
            // Error during insertion
            $error = "Error: " . $stmt->error;
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
    <title>Register User</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">
</head>
<body>
    <header class="bg-primary text-white py-3">
        <nav>
            <ul class="nav justify-content-center">
                <li class="nav-item"><a href="./index.php" class="nav-link text-white">Home</a></li>
                <li class="nav-item"><a href="ContactUs.php" class="nav-link text-white">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="registration-form py-5">
            <div class="container">
                <h2 class="text-center mb-4">Create a New Account</h2>

                <!-- Display error message if registration fails -->
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                <?php } ?>

                <!-- Registration Form -->
                <form action="register.php" method="post" id="registrationForm" class="mx-auto" style="max-width: 400px;">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required placeholder="Enter your username">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required placeholder="Create a password">
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required placeholder="Confirm your password">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                    <a href="login.php" class="btn btn-secondary btn-block">Back to Login</a>
                </form>
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

