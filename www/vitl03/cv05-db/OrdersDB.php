<?php

  class OrdersDB extends Database
  {
    public function __construct()
    {
      parent::__construct("OrdersDB", "Order");
    }


  } 
  ?>