<?php
require_once '../model/dataAccess.php';

if (isset($_REQUEST['searchByName'])) {
    $results = getCheeseByName($_REQUEST['searchByName']);
} elseif (isset($_REQUEST['searchByType'])) {
    $results = getCheeseByType($_REQUEST['searchByType']);
} elseif (isset($_REQUEST['searchByOrigin'])) {
    $results = getCheeseByOrigin($_REQUEST['searchByOrigin']);
} elseif (isset($_REQUEST['searchByStrength'])) {
    $results = getCheeseByStrength($_REQUEST['searchByStrength']);
} elseif (isset($_REQUEST['searchByPrice'])) {
    $results = getCheeseByPrice($_REQUEST['searchByPrice']);
} else {
    $results = getAllCheese();
}

// Convert the results to a format that can be easily used in JavaScript
$resultsArray = [];
foreach ($results as $cheese) {
    $resultsArray[] = $cheese->name;
}

echo json_encode($resultsArray);
?>