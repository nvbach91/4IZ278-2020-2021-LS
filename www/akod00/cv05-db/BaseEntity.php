<?php

  abstract class BaseEntity
  {
    private $id;

    /**
     * Getter method for the Id property
     * @return int
     */
    public function getId()
    {
      return $this->id;
    }

    public function __construct($id)
    {
      if ($id < 0) {
        throw new InvalidArgumentException("The value of the id cannot be less than 0");
      }

      $this->id = $id;
    }

    public function __toString()
    {
      return "To String Method not overridden";
    }
  }