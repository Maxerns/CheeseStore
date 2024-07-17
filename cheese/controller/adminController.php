<?php
session_start();

require_once '../model/cheese.php';
require_once '../model/dataAccess.php';

$results = getAllCheese();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // User is not an admin, redirect to the login page
    require_once '../view/loginView.php';
}

require_once '../view/adminView.php';
?>