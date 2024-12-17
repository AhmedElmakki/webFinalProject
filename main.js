// Ensure the form is valid before submission
document.getElementById('studentRegistrationForm').addEventListener('submit', function(event) {
    var form = this;
    if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
    }
    form.classList.add('was-validated');
});

// form secrutiy for contact us 
document.getElementById('ContactUs.php').addEventListener('submit', function(event) {
    var form = this;
    if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
    }
    form.classList.add('was-validated');
});


// rediricts the user to the login after they finish registration
document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form's default submission behavior
    alert('Registration successful! Redirecting to the login page...');
    window.location.href = 'login.php'; // Redirect to the login page
});

// ensures that the two passwords are idintical   
document.getElementById('registrationForm').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

     if (password !== confirmPassword) {
     event.preventDefault(); // Prevent form submission
     alert('Passwords do not match. Please try again.');
    }
});



