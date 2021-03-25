<?php
abstract class Base
  {
    private $id;
    public function getId()
    {
      return $this->id;
    }

    public function __construct($id)
    {
      if ($id < 0) {
        $msg= ("Invalid ID");
        return $msg;
      }

      $this -> id = $id;
    }
    public function __toString()
    {
      return "This is a to string function.";
    }
  }
?>