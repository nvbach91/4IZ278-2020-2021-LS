<?php
abstract class Database implements DatabaseOperations {
  // why is protected used here?
  protected $dbPath = './datas/'; 
  protected $dbExtension = '.db';
  protected $delimiter = ';';
  public function __construct() {

    echo '-----', static::class, ' was instantiated-----', PHP_EOL;
  }
  
  // this will get returned when one tries to stringify the instance with i.e. echo
  public function __toString() {
      return "database config: dbPath: $this->dbPath, dbExtenstion: $this->dbExtension, delimiter: $this->delimiter";
  }

  public function rewriteDB(array $data) {
    $rows = "";
    foreach($data as $row) {
      $rows .= implode($this->delimiter, $row) . "\r\n";
    }
    
    $dbName = strtolower(rtrim(static::class, "DB"));
    file_put_contents($this->dbPath . $dbName . $this->dbExtension, $rows);
  }

  public function fetchDB() {
    $dbName = strtolower(rtrim(static::class, "DB"));
    $lines = file($this->dbPath . $dbName . $this->dbExtension);
    $lines = array_filter($lines);
    $data = [];
    
    foreach ($lines as $line) {
      if (!$line || $line == "\r\n") {
        continue;
      }
      
      $fields = explode($this->delimiter, $line);
      $fields = str_replace(array(' ', "\n", "\t", "\r"), '', $fields);
      array_push($data, $fields);
    }
    return array_values($data);
  }

  public function clearData() {
    $dbName = strtolower(rtrim(static::class, "DB"));
    file_put_contents($this->dbPath . $dbName . $this->dbExtension, "");

  }

}