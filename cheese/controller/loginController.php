<?php
session_start();

require_once '../model/cheese.php';
require_once '../model/dataAccess.php';
require_once '../model/user.php';

$isAdmin = false; // Initialize $isAdmin as false

$username = isset($_REQUEST['username']) ? htmlentities($_REQUEST['username']) : '';
$password = isset($_REQUEST['password']) ? htmlentities($_REQUEST['password']) : '';

// Verify the admin credentials
$adminUsername = 'Admin';
$adminPassword = 'Admin12345';

if ($username === $adminUsername && $password === $adminPassword) {
    $isAdmin = true;
    $_SESSION['admin'] = true;
    require_once '../view/adminView.php';
    exit; // Add exit to stop further execution
}
elseif ($userId = isValidUser($username, $password, $pdo)) {
    // Generate a new session ID
    session_regenerate_id();
    $sessionId = session_id();

    // Store the session ID in the database
    // Assuming $pdo is your database connection
    $stmt = $pdo->prepare("INSERT INTO sessions (user, session) VALUES (?, ?)");
    $stmt->execute([$userId, $sessionId]);

    $_SESSION['userId'] = $userId;
    require_once '../controller/cheeseController.php';
    exit; // Add exit to stop further execution
}
else {
    require_once '../view/loginView.php';
    exit; // Add exit to stop further execution
}

require_once '../view/loginView.php';

?>