<?php

  class OrdersDb extends FakeDatabase
  {
    public function __construct()
    {
      parent::__construct("OrdersDb", "Order");
    }

    /**
     * Create a new
     * @param Order $entity Instance of an Order entity
     */
    public function create($entity)
    {
      // TODO: Implement create() method.
    }
  }