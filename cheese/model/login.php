<?php
session_start(); // Start the session

// Define the admin credentials (hardcoded for this example)
$adminUsername = 'Admin';
$adminPassword = 'Admin12345'; // This should be a securely hashed password in a real-world scenario

// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verify the admin credentials
    if ($username === $adminUsername && $password === $adminPassword) {
        // Authentication successful
        $_SESSION['admin'] = true;

        // Redirect to the AdminController or admin dashboard
        require_once '../../cheese/controller/adminController.php';
        
    } else {
        // Authentication failed
        require_once '../../cheese/controller/loginController.php';
    }
}
?>