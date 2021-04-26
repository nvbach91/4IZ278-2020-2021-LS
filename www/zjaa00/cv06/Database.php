<?php

require "./DatabaseOperations.php";

abstract class Database implements DatabaseOperations {
  protected $db;
  
  public function __construct() {
    $config = [
    
      'db2' => [
        'type'     => 'mysql',
        'name'     => 'store',
        'server'   => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'charset'  => 'utf8'
      ]
    
    ];
    
    $set = $config['db2'];
    
    $this->db = new PDO(
      "{$set['type']}:host={$set['server']};
      dbname={$set['name']};
      charset={$set['charset']}",
      $set['username'],
      $set['password']
    );
    
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }

  public function fetchBy($field, $value) {
    $sql = 'SELECT * FROM '.$this->table_name.' WHERE '.$field.' = :value';
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['value' => $value]);

    return $stmt->fetchAll();
}
}

?> 