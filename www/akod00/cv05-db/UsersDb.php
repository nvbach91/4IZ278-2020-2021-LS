<?php

  class UsersDb extends FakeDatabase
  {
    public function __construct()
    {
      parent::__construct("UsersDb", "User");
    }
  }