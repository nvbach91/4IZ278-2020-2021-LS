<?php

  class OrdersDb extends FakeDatabase
  {
    public function __construct()
    {
      parent::__construct("OrdersDb", "Order");
    }

    public function parseCsv($line)
    {
      return Order::fromCsv($line, $this->getDelimiter());
    }
  }