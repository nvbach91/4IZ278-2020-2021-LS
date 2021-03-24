<?php

interface DatabaseOperations {
    public function fetch($id);
    public function create($data);
    public function save($data);
    public function delete($id);
}

abstract class Database implements DatabaseOperations {
    protected $dbPath =  "../database/";
    protected $dbExtension = '.db';
    protected $delimiter = ';';

    public function __construct() {
        echo '-----', static::class, ' was instantiated-----', PHP_EOL;
    }

    public function __toString() {
        return "database config: dbPath: $this->dbPath, dbExtenstion: $this->dbExtension, delimiter: $this->delimiter";
    }

    public function configInfo() {
        echo $this;
    }
}


class UsersDB extends Database {
    protected $dbPath =  __DIR__ . "../../database/users";

    public function create($data) {
        $databaseFileName = $this->dbPath . $this->dbExtension;
        $Information = [
            $data['id'],
            $data['name'],
            $data['email'],
        ];
        $newRecord = implode($this->delimiter, $Information) . "\r\n";

        file_put_contents($databaseFileName, $newRecord, FILE_APPEND);
        echo 'User ', $data['name'], ' email: ', $data['email'], ' was created.', PHP_EOL;
    }

    public function fetch($id) {
        $databaseFileName = $this->dbPath . $this->dbExtension;
        $lines = file($databaseFileName);
        $delimiter = $this->delimiter;
        $exists = false;
        foreach ($lines as $line) {
            if (!$lines) {
                continue;
            }
            $fields = explode($delimiter, rtrim($line));
            $dbItem = [
                'id' => $fields[0],
                'name' => $fields[1],
                'email' => $fields[2],
            ];
            if ($dbItem['id'] == $id) {
                $exists = true;
                echo 'User ', $dbItem['name'], ' email: ', $dbItem['email'], ' was fetched.', PHP_EOL;
                break;
            }
        }

        if (!$exists) {
            echo 'A user with such id does not exist.', PHP_EOL;
        }
    }
    public function save($data) {
        $databaseFileName = $this->dbPath . $this->dbExtension;
        $lines = file($databaseFileName);
        $delimiter = $this->delimiter;
        $exists = false;
        $contents = '';

        foreach ($lines as $line) {
            if (!$lines) {
                continue;
            }
            $fields = explode($delimiter, rtrim($line));
            $dbItem = [
                'id' => $fields[0],
                'name' => $fields[1],
                'email' => $fields[2],
            ];
            if ($dbItem['id'] == $data['id']) {
                $exists = true;
                $newRecord = implode($delimiter, $data) . "\r\n";
                echo 'User ', $data['name'], ' email: ', $data['email'], ' was saved.', PHP_EOL;
            } else {
                $newRecord = implode($delimiter, $dbItem) . "\r\n";
            }
            $contents .= $newRecord;
        }
        file_put_contents($databaseFileName, $contents);
        if (!$exists) {
            echo 'A user with such id does not exist.', PHP_EOL;
        }

    }
    public function delete($id) {
        $databaseFileName = $this->dbPath . $this->dbExtension;
        $lines = file($databaseFileName);
        $delimiter = $this->delimiter;
        $exists = false;
        $contents = '';

        foreach ($lines as $line) {
            if (!$lines) {
                continue;
            }
            $fields = explode($delimiter, rtrim($line));
            $dbItem = [
                'id' => $fields[0],
                'name' => $fields[1],
                'email' => $fields[2],
            ];
            if ($dbItem['id'] == $id) {
                $exists = true;
            } else {
                $newRecord = implode($delimiter, $dbItem) . "\r\n";
                $contents .= $newRecord;
            }
        }
        file_put_contents($databaseFileName, $contents);
        if ($exists) {
            echo 'A user was deleted', PHP_EOL;
        } else {
            echo 'A user with such id does not exist.', PHP_EOL;
        }
    }
}


class ProductsDB extends Database {
    protected $dbPath =   __DIR__ . "../../database/products";


    public function create($data) {
        $databaseFileName = $this->dbPath . $this->dbExtension;
        $Information = [
            $data['id'],
            $data['name'],
            $data['price'],
        ];
        $newRecord = implode($this->delimiter, $Information) . "\r\n";

        file_put_contents($databaseFileName, $newRecord, FILE_APPEND);
        echo 'Product ', $data['name'], ' price: ', $data['price'], ' was created.', PHP_EOL;
    }

    public function fetch($id) {
        $databaseFileName = $this->dbPath . $this->dbExtension;
        $lines = file($databaseFileName);
        $delimiter = $this->delimiter;
        $exists = false;
        foreach ($lines as $line) {
            if (!$lines) {
                continue;
            }
            $fields = explode($delimiter, rtrim($line));
            $dbItem = [
                'id' => $fields[0],
                'name' => $fields[1],
                'price' => $fields[2],
            ];
            if ($dbItem['id'] == $id) {
                $exists = true;
                echo 'Product ', $dbItem['name'], ' price: ', $dbItem['price'], ' was fetched.', PHP_EOL;
                break;
            }
        }

        if (!$exists) {
            echo 'A product with such id does not exist.', PHP_EOL;
        }
    }
    public function save($data) {
        $databaseFileName = $this->dbPath . $this->dbExtension;
        $lines = file($databaseFileName);
        $delimiter = $this->delimiter;
        $exists = false;
        $contents = '';

        foreach ($lines as $line) {
            if (!$lines) {
                continue;
            }
            $fields = explode($delimiter, rtrim($line)
            );
            $dbItem = [
                'id' => $fields[0],
                'name' => $fields[1],
                'price' => $fields[2],
            ];
            if ($dbItem['id'] == $data['id']) {
                $exists = true;
                $newRecord = implode($delimiter, $data) . "\r\n";
                echo 'Product ', $data['name'], ' price: ', $data['price'], ' was saved.', PHP_EOL;
            } else {
                $newRecord = implode($delimiter, $dbItem) . "\r\n";
            }
            $contents .= $newRecord;
        }
        file_put_contents($databaseFileName, $contents);
        if (!$exists) {
            echo 'A product with such id does not exist.', PHP_EOL;
        }

    }
    public function delete($id) {
        $databaseFileName = $this->dbPath . $this->dbExtension;
        $lines = file($databaseFileName);
        $delimiter = $this->delimiter;
        $exists = false;
        $contents = '';

        foreach ($lines as $line) {
            if (!$lines) {
                continue;
            }
            $fields = explode($delimiter, rtrim($line));
            $dbItem = [
                'id' => $fields[0],
                'name' => $fields[1],
                'price' => $fields[2],
            ];
            if ($dbItem['id'] == $id) {
                $exists = true;
            } else {
                $newRecord = implode($delimiter, $dbItem) . "\r\n";
                $contents .= $newRecord;
            }
        }
        file_put_contents($databaseFileName, $contents);
        if ($exists) {
            echo 'A product was deleted', PHP_EOL;
        } else {
            echo 'A product with such id does not exist.', PHP_EOL;
        }
    }
}


class OrdersDB extends Database {
    protected $dbPath =   __DIR__ . "../../database/orders";

    public function create($data) {
        $databaseFileName = $this->dbPath . $this->dbExtension;
        $Information = [
            $data['id'],
            $data['date'],
            $data['note'],
        ];
        $newRecord = implode($this->delimiter, $Information) . "\r\n";

        file_put_contents($databaseFileName, $newRecord, FILE_APPEND);
        echo 'Order ', $data['date'], ' note: ', $data['note'], ' was created.', PHP_EOL;
    }

    public function fetch($id) {
        $databaseFileName = $this->dbPath . $this->dbExtension;
        $lines = file($databaseFileName);
        $delimiter = $this->delimiter;
        $exists = false;
        foreach ($lines as $line) {
            if (!$lines) {
                continue;
            }
            $fields = explode($delimiter, rtrim($line));
            $dbItem = [
                'id' => $fields[0],
                'date' => $fields[1],
                'note' => $fields[2],
            ];
            if ($dbItem['id'] == $id) {
                $exists = true;
                echo 'Order ', $dbItem['date'], ' note: ', $dbItem['note'], ' was fetched.', PHP_EOL;
                break;
            }
        }

        if (!$exists) {
            echo 'A order with such id does not exist.', PHP_EOL;
        }
    }
    public function save($data) {
        $databaseFileName = $this->dbPath . $this->dbExtension;
        $lines = file($databaseFileName);
        $delimiter = $this->delimiter;
        $exists = false;
        $contents = '';

        foreach ($lines as $line) {
            if (!$lines) {
                continue;
            }
            $fields = explode($delimiter, rtrim($line));
            $dbItem = [
                'id' => $fields[0],
                'date' => $fields[1],
                'note' => $fields[2],
            ];
            if ($dbItem['id'] == $data['id']) {
                $exists = true;
                $newRecord = implode($delimiter, $data) . "\r\n";
                echo 'Order ', $data['date'], ' note: ', $data['note'], ' was saved.', PHP_EOL;
            } else {
                $newRecord = implode($delimiter, $dbItem) . "\r\n";
            }
            $contents .= $newRecord;
        }
        file_put_contents($databaseFileName, $contents);
        if (!$exists) {
            echo 'A order with such id does not exist.', PHP_EOL;
        }

    }
    public function delete($id) {
        $databaseFileName = $this->dbPath . $this->dbExtension;
        $lines = file($databaseFileName);
        $delimiter = $this->delimiter;
        $exists = false;
        $contents = '';

        foreach ($lines as $line) {
            if (!$lines) {
                continue;
            }
            $fields = explode($delimiter, rtrim($line));
            $dbItem = [
                'id' => $fields[0],
                'date' => $fields[1],
                'note' => $fields[2],
            ];
            if ($dbItem['id'] == $id) {
                $exists = true;
            } else {
                $newRecord = implode($delimiter, $dbItem) . "\r\n";
                $contents .= $newRecord;
            }
        }
        file_put_contents($databaseFileName, $contents);
        if ($exists) {
            echo 'An order was deleted', PHP_EOL;
        } else {
            echo 'An order with such id does not exist.', PHP_EOL;
        }
    }
}
