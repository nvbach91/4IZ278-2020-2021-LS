<?php

  class UsersDb extends FakeDatabase
  {
    public function __construct()
    {
      parent::__construct("UsersDb", "User");
    }

    public function parseCsv($line)
    {
      return User::fromCsv($line, $this->getDelimiter());
    }
  }