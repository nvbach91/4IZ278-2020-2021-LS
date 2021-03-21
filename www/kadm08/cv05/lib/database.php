<?php

interface DatabaseOperations
{
    public function create($item);
    public function fetch();
    public function save($id, $item);
    public function delete($id);
}

abstract class Database implements DatabaseOperations
{
    private $dbFolderPath = __DIR__ . '/../database/';
    private $dbExtension = '.db';
    private $dbDelimimter = ';';
    private $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
        echo "New object is created", PHP_EOL;
    }
    public function __toString()
    {
        echo $this->dbPath . ', ' . $this->dbExtension . ', ' . $this->dbDelimimter;
    }

    private function getDbPath()
    {
        return $this->dbFolderPath . $this->fileName . $this->dbExtension;
    }

    private function replaceDb($items)
    {
        $fileContent = '';
        foreach ($items as $item) {
            $row = implode($this->dbDelimimter, $item) . "\r\n";
            $fileContent = $fileContent . $row;
        }
        file_put_contents($this->getDbPath(), $fileContent);
    }

    private function getAllItems()
    {
        $items = [];

        $records = file($this->getDbPath());

        foreach ($records as $record) {
            $record = trim($record);
            if (!$record) continue;
            $fields = explode($this->dbDelimimter, $record);
            $items[] = $fields;
        }
        return $items;
    }

    public function create($item)
    {
        $items = $this->getAllItems();
        $items[] = array_values($item);
        $this->replaceDb($items);
    }

    public function fetch()
    {
        return $this->getAllItems();
    }

    public function save($id, $item)
    {
        $items = $this->getAllItems();

        foreach ($items as $index => $oldItem) {
            if ($oldItem[0] == $id) {
                $items[$index] = array_values($item);
            }
        }
        $this->replaceDb($items);
    }

    public function delete($id)
    {
        $items = $this->getAllItems();

        foreach ($items as $index => $oldItem) {
            if ($oldItem[0] == $id) {
                unset($items[$index]);
            }
        }
        $this->replaceDb($items);
    }
}
