<?php

class PurchasedItem {
    private $purchases;
    private $cheese;
    private $quantity;

    function __get($purchasedItem) {
        return $this->$purchasedItem;
    }

    function __set($purchasedItem, $value) {
        $this->$purchasedItem = $value;
    }

}

?>