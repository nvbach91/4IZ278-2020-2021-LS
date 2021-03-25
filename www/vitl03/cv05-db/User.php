<?php
    require_once "Base.php";
  class User extends Base
  {
    private $name;
    private $age;

    public function __construct($id, $name, $age)
    {
      parent::__construct($id);
      $this->name = $name;
      $this->age = $age;
    }

    public function getName()
    {
      return $this->name;
    }

    public function getAge()
    {
      return $this->age;
    }
    public function __toString()
    {
      return "[" . $this -> getId() . ", " . $this->name . ", " . $this->age . "]";
    }
  } 
  ?>