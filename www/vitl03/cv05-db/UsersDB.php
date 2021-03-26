<?php

  class UsersDB extends Database
  {
    public function __construct()
    {
      parent::__construct("UsersDB", "User");
    }

  } 
  ?>