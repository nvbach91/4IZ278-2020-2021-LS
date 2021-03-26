<?php

require "DatabaseOperations.php";


abstract class Database implements DatabaseOperations
{
    private $name;
    private $dataName;
    private $dbPath = '/database';
    private $dbExtension = '.db';
    private $delimiter = ';';

    public function __construct($name, $dataName)
    {
        $this->name = $name;
        $this->dataName = $dataName;
        echo "An instance of " . $this->getName() . " was instantiated.", PHP_EOL;
    }

    public function getConfig() {
        echo "Path: " . $this->dbPath . ", Extension: " . $this->dbExtension . ", Delimiter: " . $this->delimiter, PHP_EOL;
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
        return $this->getName();
    }

    public function fetch()
    {
        echo "A '" . $this->getDataName() . "' was fetched.", PHP_EOL;
    }

    public function create($data)
    {
        echo "A new " . $this->getDataName() . " was created: " . $data, PHP_EOL;
    }

    public function getDataName()
    {
        return $this->dataName;
    }

    public function save()
    {
        echo "A '" . $this->getDataName() . "' was saved.", PHP_EOL;
    }

    public function delete()
    {
        echo "A '" . $this->getDataName() . "' was deleted.", PHP_EOL;
    }

    public function getDbPath()
    {
        return $this->dbPath;
    }

    public function setDbPath($dbPath)
    {
        $this->dbPath = $dbPath;
    }


    public function getDbExtension()
    {
        return $this->dbExtension;
    }

    public function setDbExtension($dbExtension)
    {
        $this->dbExtension = $dbExtension;
    }

    public function getDelimiter()
    {
        return $this->delimiter;
    }


    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;
    }



   
}
?>
