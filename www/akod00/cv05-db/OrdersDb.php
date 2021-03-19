<?php

  class OrdersDb extends FakeDatabase
  {
    public function __construct()
    {
      parent::__construct("OrdersDb", "Order");
    }
  }