<?php


abstract class Database implements DatabaseOperations
{
    protected $path = './databases';
    protected $extension = '.db';
    protected $delimiter = ';';
    protected $file = null;

    public function __construct()
    {
        echo "-----", static::class, " was instantinated", "-----", PHP_EOL;
    }

    public function __toString()
    {
        return "database configuration: Path: " . $this->path . ", Extension: " . $this->extension . ", Delimiter: " . $this->delimiter . PHP_EOL;
    }

    protected function readDatabase() {
        if ($this->file != null) {
            $rows = file($this->path . "/" . $this->file . $this->extension);
            $data = array();
            foreach ($rows as $row) {
                if ($row == "\r\n" || !$row) {
                    continue;
                }
                array_push($data, str_replace("\r\n", "", explode($this->delimiter, $row)));
            }
            return $data;
        }
        echo "-----", " ERROR database file not defined ", "-----", PHP_EOL;
        die();
    }

    protected function writeDatabase($data) {
        if ($this->file != null) {
            $rawData = "";
            foreach ($data as $row) {
                $rawData .= implode($this->delimiter, $row) . "\r\n";
            }
            file_put_contents($this->path . "/" . $this->file . $this->extension, $rawData);
            return;
        }
        echo "-----", " ERROR database file not defined ", "-----", PHP_EOL;
        die();
    }

}