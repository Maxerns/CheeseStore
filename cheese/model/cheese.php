<?php

class Cheese implements JsonSerializable {

    private $id;
    private $name;
    private $type;
    private $origin;
    private $strength;
    private $price;

    function __get($name)
    {
      return $this->$name;
    }

    function __set($name,$value)
    {
        $this->$name = $value;
    } 

    function jsonSerialize()
    {
        return get_object_vars($this);
    }

}

?>