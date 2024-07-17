<?php

class User {

    private $id;
    private $username;
    private $password;

    function __get($username)
    {
      return $this->$username;
    }

    function __set($username,$value)
    {
        $this->$username = $value;
    } 

}

?>