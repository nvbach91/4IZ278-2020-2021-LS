<?php

  class ProductsDb extends FakeDatabase
  {
    public function __construct()
    {
      parent::__construct("ProductsDb", "Product");
    }

    /**
     * Creates a new entry of a product in the database
     * @param Product $entity Instance of a Product entity
     */
    public function create($entity)
    {
      // TODO: Implement create() method.
    }
  }