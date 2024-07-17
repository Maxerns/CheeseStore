<?php
session_start();

require_once '../model/cheese.php';
require_once '../model/dataAccess.php';
require_once '../model/user.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlentities($_REQUEST["username"]);
    $password = htmlentities($_REQUEST["password"]);

    // Create a new user
    $user = new User();
    $user->username = htmlentities($username);
    $user->password = htmlentities($password);

    // Add the user to the database
    addNewUser($user, $pdo);

    // Redirect to the login page
    require_once '../view/loginView.php';

}

require_once '../../cheese/view/signupView.php';
?>