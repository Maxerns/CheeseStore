<?php
require_once '../model/dataAccess.php';
require_once '../model/customer.php';
require_once '../model/cheese.php';
require_once '../model/purchases.php';
require_once '../model/purchasedItem.php';

session_start();


if (!isset($_SESSION["basket"])) {
    $_SESSION["basket"] = [];
}

$basket = $_SESSION["basket"];

// Retrieve customer data from the request
$customer = new Customer();
$customer->fullname = $_REQUEST["fullname"];
$customer->email = $_REQUEST["email"];
$customer->phoneNumber = $_REQUEST["phone"];
$customer->address = $_REQUEST["address"];

// Call the addNewCustomer function with individual properties
addNewCustomer($customer->fullname, $customer->email, $customer->phoneNumber, $customer->address, $pdo);

// Retrieve the ID of the newly inserted customer
$customer_id = $pdo->lastInsertId();

// Retrieve the logged-in user's ID. If no user is logged in, $userId will be null.
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;

// Check if the customer ID is valid before proceeding
if ($customer_id) {
    // Call addPurchases with the customer ID and user ID
    $purchases_id = addPurchases($customer_id, $userId, $pdo);

    // Add purchased items
    foreach ($basket as $cheese) {
        $quantity = isset($_REQUEST["quantity"][$cheese->id]) ? $_REQUEST["quantity"][$cheese->id] : 1;
        addPurchasedItem($purchases_id, $cheese->id, $quantity, $pdo);
    }

    // Clear the basket after successful purchase
    $_SESSION["basket"] = [];
    $basket = $_SESSION["basket"];
}

?>
