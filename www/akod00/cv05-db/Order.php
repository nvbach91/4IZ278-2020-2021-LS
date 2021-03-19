<?php

  class Order extends BaseEntity
  {
    private $createdBy;
    private $products;

    /**
     * Order constructor.
     * @param int $id Entity id
     * @param int $createdBy Author user id
     * @param int[] $products Ordered product ids
     */
    public function __construct($id, $createdBy, $products)
    {
      parent::__construct($id);
      $this->createdBy = $createdBy;
      $this->products = $products;
    }

    /**
     * Getter property for the Products property
     * @return int[] Product ids
     */
    public function getProducts()
    {
      return $this->products;
    }

    /**
     * Getter property for the CreatedBy property
     * @return int User id
     */
    public function getCreatedBy()
    {
      return $this->createdBy;
    }
  }