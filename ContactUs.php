<?php
// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database connection settings
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

// If the form is submitted, process the data
$successMessage = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert the data into the contact_us table
    $sql = "INSERT INTO contact_us (full_name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $fullName, $email, $subject, $message);

    if ($stmt->execute()) {
        // Success, set the success message
        $successMessage = "Thank you for your message! We will get back to you soon.";
    } else {
        // Error, show an error message
        echo "Error: " . $stmt->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">
    <style>
        /* Style for the modal */
        .modal-body {
            text-align: center;
        }
    </style>
</head>
<body>

    <header class="bg-primary text-white py-3">
        <nav>
            <ul class="nav justify-content-center">
                <li class="nav-item"><a href="./index.php" class="nav-link text-white">Home</a></li>
                <li class="nav-item"><a href="dashboard.php" class="nav-link text-white">Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main class="py-5">
        <div class="container">
            <section class="contact-us" id="contactUsForm">
                <h2 class="text-center mb-4">Contact Us</h2>
                <p class="text-center mb-4">Have any questions or concerns? Feel free to reach out to us using the form below.</p>

                <!-- Contact Form -->
                <form action="ContactUs.php" method="post" id="contactForm">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" required placeholder="Enter your full name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email address">
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required placeholder="Enter the subject">
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required placeholder="Write your message"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                </form>
            </section>
        </div>
    </main>

    <!-- Modal for Thank You Message -->
    <?php if ($successMessage): ?>
    <div class="modal fade" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="thankYouModalLabel">Thank You!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo $successMessage; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Display the modal after form submission
        $(document).ready(function() {
            $('#thankYouModal').modal('show');
        });
    </script>
    <?php endif; ?>

    <footer class="bg-dark text-white text-center py-3">
        <p>Student Management System</p>
    </footer>

    <!-- Link to Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
