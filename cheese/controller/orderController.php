<?php
require_once '../model/dataAccess.php';
require_once '../model/purchases.php';
require_once '../model/user.php';
require_once '../model/cheese.php';

session_start();
$userId = $_SESSION['userId'];
$orders = getPurchasesByUser($userId);

// Fetch the cheeses for each order
foreach ($orders as $key => $order) {
    $cheeses = getCheesesByOrder(htmlentities($order['id']));
    $orders[$key]['cheeses'] = $cheeses;
}

require_once '../view/orderView.php';
?>
