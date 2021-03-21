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
      return sprintf("[%d, %s]", $this->getId(), $this->name);
    }

    public function toCsv($delimiter)
    {
      return sprintf("%d%s%s", $this->getId(), $delimiter, $this->name);
    }

    public static function fromCsv($entry, $delimiter)
    {
      $split = explode($delimiter, $entry);

      return new User((int)$split[0], $split[1]);
    }
  }