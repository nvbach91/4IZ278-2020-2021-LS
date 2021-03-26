<?php

interface DatabaseOperations {
    public function create($args);
    public function fetch($id);
    public function update($id, $args);
    public function delete($id);
}

abstract class AbstractDatabase implements DatabaseOperations {
    protected $dbPath = '/datafiles';
    protected $dbExtension = '.db';
    protected $separator = ';';
    protected $filePath;
    protected $columns;
    protected $idIndex;

    public function __construct($fileName, $keys, $idIndex) {
        $this->filePath = dirname(__DIR__) . "$this->dbPath$fileName$this->dbExtension";
        $this->columns = $keys;
        $this->idIndex = $idIndex;
        echo '----------------------------- ', static::class, ' was instantiated -----------------------------',  nl2br("\n\n");
    }

    public function __toString() {
        return "database config: dbPath: $this->dbPath, dbExtenstion: $this->dbExtension, delimiter: $this->delimiter";
    }

    public function clear() {
        file_put_contents($this->filePath, '');
    }

    protected function updateRecord($id, $newRecord) {
        $data = file($this->filePath);
        $updatedLine = null;

        foreach($data as $line) {
            $line = $line;
            if (!$line) {
                continue;
            }

            $fields = explode(';', $line);
            if ($fields[$this->idIndex] === $id) {
                // record found
                $updatedLine = $line;
                break;
            }
        }

        if ($updatedLine) {
            $data = str_replace($updatedLine, $newRecord, $data);
        }

        file_put_contents($this->filePath, $data);
        return $updatedLine;
    }

    protected function getAllData() {
        $resultData = [];
        $records = file($this->filePath);

        foreach ($records as $record) {
            $record = trim($record);

            if (!$record) {
                continue;
            }

            $fields = explode(';', $record);
            $data = [];

            for($i = 0; $i < count($this->columns); $i++) {
                $data[$this->columns[$i]] = $fields[$i]; 
            }

            $resultData[$fields[$this->idIndex]] = $data;
        }

        return $resultData;
    }

    protected function getRecord($id) {
        $records = file($this->filePath);
    
        foreach ($records as $record) {
            $record = trim($record);
            if (!$record) {
                continue;
            }
    
            $fields = explode(';', $record);
            if ($fields[$this->idIndex] === $id) {
                $data = [];

                for($i = 0; $i < count($this->columns); $i++) {
                    $data[$this->columns[$i]] = $fields[$i]; 
                }

                // record found
                return $data;
            }
        }
    
        // record not found
        return null;
    }

    protected function removeRecord($recordId) {
        $deleteLine = $this->updateRecord($recordId, '');
        return $deleteLine;
    }

    protected function getUpdatedRecord($user, $newValues) {
        $updatedColumns = array_keys($newValues);
        $data = [];

        for ($i = 0; $i < count($this->columns); $i++) {
            // check for wrong names of columns in update query
            if ($i < count($updatedColumns) && !in_array($updatedColumns[$i], $this->columns)) {
                return;
            }

            $user[$this->columns[$i]] = key_exists($this->columns[$i], $newValues) ? $newValues[$this->columns[$i]] : $user[$this->columns[$i]];
            $data[$i] = $user[$this->columns[$i]];
        }

        // no need to return the new updated line here
        $newLine = $this->updateRecord($user[$this->columns[$this->idIndex]], implode($this->separator, $data) . "\r\n"); 

        return $user;
    }

    protected function createRecord($args) {
        $newData = [];
        for ($i = 0; $i < count($this->columns); $i++) {
            $newData[$i] = $args[$this->columns[$i]]; 
        }

        $newRecord = implode($this->separator, $newData) . "\r\n";
        file_put_contents($this->filePath, $newRecord, FILE_APPEND);
    }

    protected function outputNotFoundIdMessage($command, $tableName, $id) {
        echo $command, ' failed. ', $tableName, ' with ', $this->columns[$this->idIndex], ': "'  , $id , '" was not found.', nl2br("\n");
    }

    protected function outputAlreadyExistingIdMessage($tableName, $args) {
        echo $tableName, ' cannot be created. ', $tableName, ' with ', $this->columns[$this->idIndex], ': "', $args[$this->columns[$this->idIndex]], '" already exists.', nl2br("\n");
    }
}

?>