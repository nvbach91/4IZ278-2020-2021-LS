<?php

  class ProductsDB extends Database
  {
    public function __construct()
    {
      parent::__construct("ProductsDB", "Product");
    }

  } 
  ?>