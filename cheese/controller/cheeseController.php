<?php
session_start();

require_once '../model/cheese.php';
require_once '../model/dataAccess.php';

if (!isset($_SESSION["basket"])) {
    $_SESSION["basket"] = [];
}

if (isset($_REQUEST["searchByName"])) 
{
    $search = $_REQUEST["searchByName"];
    $results = getCheeseByName($search);
    //echo json_encode ($results);
}
elseif (isset($_REQUEST["searchByType"]))
{
    $search = $_REQUEST["searchByType"];
    $results = getCheeseByType($search);
    //echo json_encode ($results);
} 
elseif (isset($_REQUEST["searchByOrigin"])) 
{
    $search = $_REQUEST["searchByOrigin"];
    $results = getCheeseByOrigin($search);
    // echo json_encode ($results);
} 
elseif (isset($_REQUEST["searchByStrength"])) 
{
    $search = $_REQUEST["searchByStrength"];
    $results = getCheeseByStrength($search);
    // echo json_encode ($results);
} 
elseif (isset($_REQUEST["searchByPrice"])) 
{
    $search = $_REQUEST["searchByPrice"];
    $results = getCheeseByPrice($search);
    // echo json_encode ($results);
} 
else 
{
    $results = getAllCheese();
    
}

if (isset($_REQUEST["basket"])) {
    $basketID = $_REQUEST["basket"];
    $customerObject = getCheeseByID($basketID);
    $_SESSION["basket"][] = $customerObject;
}





require_once '../../cheese/view/productView.php';

?>
