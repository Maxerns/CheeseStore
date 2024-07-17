<?php
require_once '../model/dataAccess.php';

// Get the form data and apply HTML entities
$id = htmlentities($_REQUEST['id']);
$name = htmlentities($_REQUEST['name']);
$type = htmlentities($_REQUEST['type']);
$origin = htmlentities($_REQUEST['origin']);
$strength = htmlentities($_REQUEST['strength']);
$price = htmlentities($_REQUEST['price']);
// Get other cheese properties from the form and apply HTML entities


updateCheese($id, $name, $type, $origin, $strength, $price);

// Redirect or display a success message
require_once '../../cheese/controller/adminController.php';
?>