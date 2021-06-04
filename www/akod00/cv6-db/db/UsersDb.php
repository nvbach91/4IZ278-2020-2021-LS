<?php
  require_once __DIR__ . '/BaseDatabase.php';

  class UsersDatabase extends BaseDatabase
  {
    /**
     * UsersDatabase constructor.
     */
    public function __construct()
    {
      parent::__construct("users");
    }

    public function create($args) {
      $sql = 'INSERT INTO ' . $this->getTableName() . '(name, email, age) VALUES (:name, :email, :age)';
      $statement = $this->pdo->prepare($sql);
      $statement->execute([
        'name' => $args['name'],
        'email' => $args['email'],
        'age' => $args['age']
      ]);
    }
  }