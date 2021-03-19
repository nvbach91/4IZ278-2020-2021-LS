<?php

  class Product extends BaseEntity
  {
    private $name;
    private $price;

    /**
     * Product constructor.
     * @param int $id
     * @param string $name
     * @param double $price
     */
    public function __construct($id, $name, $price)
    {
      parent::__construct($id);
      $this->name = $name;
      $this->price = $price;
    }

    /**
     * Getter method for the Name property
     * @return string product name
     */
    public function getName()
    {
      return $this->name;
    }

    /**
     * Getter method for the Price property
     * @return double product price
     */
    public function getPrice()
    {
      return $this->price;
    }

    public function __toString()
    {
      return "[" . $this->getId() . ", " . $this->name . ", " . $this->price . "]";
    }
  }