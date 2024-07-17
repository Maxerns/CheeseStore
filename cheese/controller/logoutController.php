<?php
session_start();
unset($_SESSION['userId']);
unset($_SESSION['admin']); 

require_once '../../cheese/view/loginView.php';
?>