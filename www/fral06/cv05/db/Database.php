<?php

require 'DatabaseOperations.php';

abstract class Database implements DatabaseOperations
{
//    protected $name;
//    protected $entityName;
    protected $dbPath = 'db/external/';
    protected $dbExtension = '.db';
    protected $delimiter = ';';
    protected $columns;
    protected $dbName;

    public function __construct($columns, $dbName)
    {
        $this->columns = $columns;
        $this->dbName = $dbName;

        echo static::class . " was instantiated", PHP_EOL;
        echo $this->getDbPath();
        if (!file_exists($this->getDbPath())) {
            touch($this->getDbPath());
            echo "DB file created", PHP_EOL;
        }
    }

    public function __toString()
    {
        return "db config: dbPath: $this->dbPath, dbExtenstion: $this->dbExtension, delimiter: $this->delimiter";
    }

    public function getConfig()
    {
        return $this;
    }

    public function clear()
    {
        file_put_contents($this->dbPath, '');
    }

    public function getDbPath()
    {
        return $this->dbPath . $this->dbName . $this->dbExtension;
    }

    private function fetchItem($id)
    {
        $data = file($this->getDbPath());
        $item = [];

        foreach ($data as $record) {
            $record = trim($record);
            if (!$record) continue;

            $fields = explode($this->delimiter, $record);
            if ($fields[0] === $id) {
                for ($i = 0; $i < count($this->columns); $i++) {
                    $item[$this->columns[$i]] = $fields[$i];
                }
                break;
            }
        }
        return $item;
    }

    public function fetch()
    {
        $data = file($this->getDbPath());
        $items = [];

        foreach ($data as $record) {
            $record = trim($record);
            if (!$record) continue;

            $fields = explode($this->delimiter, $record);

            for ($i = 0; $i < count($this->columns); $i++) {
                $item[$this->columns[$i]] = $fields[$i];
            }

            array_push($items, $item);

        }
        return $items;
    }

    public function create($args)
    {
        if ($this->fetchItem($args['id']) != null) {
            echo  static::class . ' record already exists', PHP_EOL;
            return;
        }

        $record = implode($this->delimiter, $args) . "\r\n";

        file_put_contents($this->getDbPath(), $record, FILE_APPEND);
        echo  static::class. " record was created", PHP_EOL;
    }

    public function update($id, $args) {
        $data = file($this->getDbPath());
        $updatedLine = null;

        foreach($data as $record) {
            if (!$record) {
                continue;
            }

            $field = explode($this->delimiter, $record);
            if ($field[0] === $id) {
                // record found
                $updatedLine = $record;
                break;
            }
        }

        if ($updatedLine) {
            $data = str_replace($updatedLine, implode($this->delimiter, $args), $data);
            file_put_contents($this->getDbPath(), $data);
            echo  static::class . " record was updated", PHP_EOL;
        } else {
            echo  static::class . " record was not found", PHP_EOL;
        }

        return $updatedLine;
    }

    public function delete($id)
    {
       $this->update($id, []);
    }


}
