<?php

class Purchases {

    private $customer;

    function __get($customer) #
  {
     return $this->$customer;
  }

  function __set($customer, $value) 
  {
     $this->$customer = $value;
  }

}

?>