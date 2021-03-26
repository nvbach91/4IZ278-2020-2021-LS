<?php

  class Product extends Base
  {
    private $name;
    private $price;


    public function __construct($id, $name, $price)
    {
      parent::__construct($id);
      $this->name = $name;
      $this->price = $price;
    }

    public function getName()
    {
      return $this->name;
    }


    public function getPrice()
    {
      return $this->price;
    }

    public function __toString()
    {
      return "[" . $this->getId() . ", " . $this->name . ", " . $this->price . "]";
    }
  } 
  ?>