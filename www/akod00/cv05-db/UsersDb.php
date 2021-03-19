<?php

  class UsersDb extends FakeDatabase
  {
    public function __construct()
    {
      parent::__construct("UsersDb", "User");
    }

    /**
     * Creates a new entry of a user in the database
     * @param User $entity Instance of a user entity
     */
    public function create($entity)
    {
      // TODO: Implement create() method.
    }
  }