<?php

  class Order extends Base
  {
    private $userID;
    private $products;


    public function __construct($id, $userID, $products)
    {
      parent::__construct($id);
      $this->userID = $userID;
      $this->products = $products;
    }

    public function getProducts()
    {
      return $this->products;
    }


    public function getUserID()
    {
      return $this->userID;
    }

    public function __toString()
    {
      return "[" . "Order number: " . $this -> getId() . ", " . " User ID: " . $this->userID . ", Product ID's: " . implode(", ", $this->products) . "]";
    }
  } 