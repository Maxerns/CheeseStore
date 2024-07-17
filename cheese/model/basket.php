<?php

require_once '../model/dataAccess.php';
require_once '../model/cheese.php';
require_once '../model/customer.php';

session_start();

if (isset($_REQUEST['remove'])) {
    $itemId = $_REQUEST['remove'];

    // Find the item in the basket and remove it
    foreach ($_SESSION['basket'] as $index => $item) {
        if ($item->id == $itemId) {
            unset($_SESSION['basket'][$index]);
        }
    }
}

// Only include the checkout process if the checkout form is submitted
if (isset($_REQUEST['checkoutForm'])) {
    require_once '../model/checkout.php';
}

require_once '../../CheeseStore/cheese/view/basketView.php';

?>