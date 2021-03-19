<?php

  require_once "BaseEntity.php";

  class User extends BaseEntity
  {
    private $name;

    /**
     * User constructor
     * @param int $id Entity id
     * @param string $name User name
     */
    public function __construct($id, $name)
    {
      parent::__construct($id);
      $this->name = $name;
    }

    /**
     * Getter property for the Name property
     * @return string User name
     */
    public function getName()
    {
      return $this->name;
    }

    public function __toString()
    {
      return "[" . $this->getId() . ", " . $this->name . "]";
    }
  }