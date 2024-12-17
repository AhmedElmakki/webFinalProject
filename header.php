<?php
// Start the session only if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get the current page's filename
$current_page = basename($_SERVER['PHP_SELF']);

// If the user is not logged in and is not on the ContactUs page, redirect to login
if ($current_page != 'ContactUs.php' && $current_page != 'index.php'  && !isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();  // Ensure no further script execution
}

// If activities session variable does not exist, create it
if (!isset($_SESSION['activities'])) {
    $_SESSION['activities'] = [];
}

// Log the current activity
$timestamp = date('Y-m-d H:i:s');
$activity = [
    'page' => $current_page,
    'timestamp' => $timestamp,
];

// Add the current activity to the session
array_push($_SESSION['activities'], $activity);

// Limit the number of activities to 5
if (count($_SESSION['activities']) > 5) {
    array_shift($_SESSION['activities']);
}
?>
