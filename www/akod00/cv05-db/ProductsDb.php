<?php

  class ProductsDb extends FakeDatabase
  {
    public function __construct()
    {
      parent::__construct("ProductsDb", "Product");
    }
  }