<?php

class Customer {

    private $id;
    private $fullname;
    private $email;
    private $phoneNumber;
    private $address;

    function __get($fullname)
    {
      return $this->$fullname;
    }

    function __set($fullname,$value)
    {
        $this->$fullname = $value;
    } 

}

?>