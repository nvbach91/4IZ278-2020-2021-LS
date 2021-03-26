<?php

  class ProductsDb extends FakeDatabase
  {
    public function __construct()
    {
      parent::__construct("ProductsDb", "Product");
    }

    public function parseCsv($line)
    {
      return Product::fromCsv($line, $this->getDelimiter());
    }
  }