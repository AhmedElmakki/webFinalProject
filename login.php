<?php
// Start session to access session variables
session_start();

// If user is already logged in, redirect to the dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

// Database connection
$servername = "localhost";  // Database server
$username = "root";         // Database username
$password = "";             // Database password (blank for localhost by default)
$dbname = "students_db";    // Database name

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

    // Check if username exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password using password_verify
        if (password_verify($pass, $row['password'])) {
            // Password is correct, start session and redirect to dashboard
            $_SESSION['username'] = $user; // Store username in session variable
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid password
            $error = "Invalid username or password!";
        }
    } else {
        // Invalid username
        $error = "Invalid username or password!";
    }

    $stmt->close();
}
$conn->close();
?>

<!-- HTML Part -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">
</head>
<body>
    <header class="bg-primary text-white py-3">
        <nav>
            <ul class="nav justify-content-center">
                <li class="nav-item"><a href="index.php" class="nav-link text-white">Home</a></li>
                <li class="nav-item"><a href="ContactUs.php" class="nav-link text-white">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="login-form py-5">
            <div class="container">
                <h2 class="text-center mb-4">Login to Your Account</h2>
                <form action="login.php" method="post" class="mx-auto" style="max-width: 400px;">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required placeholder="Enter your username">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required placeholder="Enter your password">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                    <a href="register.php" class="btn btn-secondary btn-block">Register</a>

                    <?php
                    // Display error message if login fails
                    if (isset($error)) {
                        echo "<div class='alert alert-danger mt-3'>$error</div>";
                    }
                    ?>
                </form>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white text-center py-3">
        <p>Student Management System</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
