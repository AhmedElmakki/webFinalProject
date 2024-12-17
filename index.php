<?php   include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Link to external CSS -->
    <link href="custom.css" rel="stylesheet">
</head>
<body>

    <header class="bg-primary text-white py-3">
        <nav>
            <ul class="nav justify-content-center">
                <li class="nav-item"><a href="dashboard.php" class="nav-link text-white">dashboard</a></li>
                <li class="nav-item"><a href="ContactUs.php" class="nav-link text-white">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero text-center py-5">
            <div class="container">
                <h1 class="display-4">Welcome to the Student Management System</h1>
                <p class="lead">Your comprehensive tool for managing student data. </p>
                <a href="login.php" class="btn btn-primary btn-lg">Login</a>
                <a href="register.php" class="btn btn-primary btn-lg">Register</a> <!-- Call-to-action button for login -->
            </div>
        </section>

        <section class="features py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-4">Key Features</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Student Registration</h3>
                                <p class="card-text">Easily register new students with all necessary details.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Student Removal</h3>
                                <p class="card-text">Remove any Student effortlessly.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">List students</h3>
                                <p class="card-text">View all registered students on the system in real time</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Video and Image Player Section -->
        <section class="media-section py-5">
            <div class="container">
                <h2 class="text-center mb-4">Media Gallery</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="embed-responsive embed-responsive-16by9 mb-4">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/v_C0Ky3sE4M?si=DOD4arBs8odwhCW-" allowfullscreen></iframe>
                        </div>
                        <p class="text-center">Video of our beloved college</p>
                    </div>
                    <div class="col-md-6">
                        <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="https://media.istockphoto.com/id/1351018006/photo/smiling-male-student-sitting-in-university-classroom.jpg?s=612x612&w=0&k=20&c=G9doLib_ILUijluTSD5hstZBWqHHIcw4dBHhQcs-ON4=" class="d-block w-100" alt="Sample Image 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://media.istockphoto.com/id/1470208665/photo/multi-ethnic-group-of-latin-and-african-american-college-students-smiling-diversity-portrait.jpg?s=612x612&w=0&k=20&c=NlJzvXsDFQYbBz08z2-caVwgeTH_qK-iS9rMgv9l6o8=" class="d-block w-100" alt="Sample Image 2">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://media.istockphoto.com/id/1438185814/photo/college-student-asian-man-and-studying-on-laptop-at-campus-research-and-education-test-exam.jpg?s=612x612&w=0&k=20&c=YmnXshbaBxyRc4Nj43_hLdLD5FLPTbP0p_3-uC7sjik=" class="d-block w-100" alt="Sample Image 3">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <p class="text-center mt-3">Our students</p>
                    </div>
                </div>
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

