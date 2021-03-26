<?php

abstract class Database implements DatabaseOperations {
    protected $dbPath = __DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR; 
    protected $dbExtension = '.db';
    protected $delimiter = ';';

    public function __construct() {
        echo '<br>-----', static::class, ' was instantiated-----<br>', PHP_EOL;
    }

    public function __toString() {
        return "database config: dbPath: $this->dbPath, dbExtension: $this->dbExtension, delimiter: $this->delimiter";
    }

    public function configInfo() { 
        echo $this;
    }

}
?>
