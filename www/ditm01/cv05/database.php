<?php
interface DatabaseOperations {
    public function fetch($args);
    public function create($args);
    public function update($args);
    public function delete($args);
}

abstract class Database implements DatabaseOperations {
    protected $dbPath = 'db/';
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
    public function create($args) {
        $file = file($this->dbPath . "users" . $this->dbExtension);
        $alreadyExists = false;
        foreach ($file as $row) {
            if (!$row) {
                continue;
            }
            $fields = explode($this->delimiter, $row);
            $user = [
                'id' => $fields[0],
                'name' => $fields[1],
                'age' => $fields[2],
            ];
            if ($user['id'] == $args['id']) {
                $alreadyExists = true;
            }
        }
        if (!$alreadyExists) {
            $newRecord = implode($this->delimiter, $args) . "\r\n";
            file_put_contents($this->dbPath . "users" . $this->dbExtension, $newRecord, FILE_APPEND);
            echo 'User (ID: ', $args['id'], ', NAME: ', $args['name'], ', AGE: ', $args['age'], ') was created', PHP_EOL;
        } else {
            echo 'A user already exists', PHP_EOL;
        }
    }
    public function fetch($args) {
        $file = file($this->dbPath . "users" . $this->dbExtension);
        $alreadyFound = false;
        foreach ($file as $row) {
            if (!$row) {
                continue;
            }
            $fields = explode($this->delimiter, $row);
            $user = [
                'id' => $fields[0],
                'name' => $fields[1],
                'age' => $fields[2],
            ];
            if ($user['id'] == $args['id']) {
                $success = $user;
                $alreadyFound = true;
            }
        }
        if (!$alreadyFound) {
            echo 'A user (ID: ', $args['id'],') was fetched', PHP_EOL;
            echo 'A user does not exist', PHP_EOL;
        } else {
            echo 'A user (ID: ', $success['id'],') was fetched', PHP_EOL;
            echo 'Fetched user -> ID: ', $success['id'], ', NAME: ', $success['name'], ', AGE: ', $success['age'], PHP_EOL;
        }
    }
    public function update($args) {
        $file = file($this->dbPath . "users" . $this->dbExtension);
        $alreadyFound = false;
        foreach ($file as $row) {
            if (!$row) {
                continue;
            }
            $fields = explode($this->delimiter, $row);
            $user = [
                'id' => $fields[0],
                'name' => $fields[1],
                'age' => $fields[2],
            ];
            if ($user['id'] == $args['id']) {
                $success = $user;
                $successString = implode($this->delimiter, $user);
                $replaceRecord = implode($this->delimiter, $args) . "\r\n";
                $replace = str_replace($successString, $replaceRecord, $file);
                file_put_contents($this->dbPath . "users" . $this->dbExtension, $replace);
                $alreadyFound = true;
                
            }
        }
        if (!$alreadyFound) {
            echo 'A user does not exist', PHP_EOL;
        } else {
            echo 'A user (ID: ', $success['id'],') was updated', PHP_EOL;
            echo 'New record -> ID: ', $args['id'], ', NAME: ', $args['name'], ', AGE: ', $args['age'], PHP_EOL;
        }
    }
    public function delete($args) {
        $file = file($this->dbPath . "users" . $this->dbExtension);
        $alreadyFound = false;
        foreach ($file as $row) {
            if (!$row) {
                continue;
            }
            $fields = explode($this->delimiter, $row);
            $user = [
                'id' => $fields[0],
                'name' => $fields[1],
                'age' => $fields[2],
            ];
            if ($user['id'] == $args['id']) {
                $success = $user;
                $successString = implode($this->delimiter, $user);
                $replace = str_replace($successString,'', $file);
                file_put_contents($this->dbPath . "users" . $this->dbExtension, $replace);
                $alreadyFound = true;
                
            }
        }
        if (!$alreadyFound) {
            echo 'A user does not exist', PHP_EOL;
        } else {
            echo 'A user (ID: ', $success['id'],') was deleted', PHP_EOL;
            echo 'Deleted record -> ID: ', $success['id'], ', NAME: ', $success['name'], ', AGE: ', $success['age'], PHP_EOL;
        }
    }
}

class ProductsDB extends Database {
    public function create($args) {
        $file = file($this->dbPath . "products" . $this->dbExtension);
        $alreadyExists = false;
        foreach ($file as $row) {
            if (!$row) {
                continue;
            }
            $fields = explode($this->delimiter, $row);
            $product = [
                'id' => $fields[0],
                'name' => $fields[1],
                'price' => $fields[2],
            ];
            if ($product['id'] == $args['id']) {
                $alreadyExists = true;
            }
        }
        if (!$alreadyExists) {
            $newRecord = implode($this->delimiter, $args) . "\r\n";
            file_put_contents($this->dbPath . "products" . $this->dbExtension, $newRecord, FILE_APPEND);
            echo 'Product (ID: ', $args['id'], ', NAME: ', $args['name'], ', PRICE: ', $args['price'], ') was created', PHP_EOL;
        } else {
            echo 'A product already exists', PHP_EOL;
        }
    }
    public function fetch($args) {
        $file = file($this->dbPath . "products" . $this->dbExtension);
        $alreadyFound = false;
        foreach ($file as $row) {
            if (!$row) {
                continue;
            }
            $fields = explode($this->delimiter, $row);
            $product = [
                'id' => $fields[0],
                'name' => $fields[1],
                'price' => $fields[2],
            ];
            if ($product['id'] == $args['id']) {
                $success = $product;
                $alreadyFound = true;
            }
        }
        if (!$alreadyFound) {
            echo 'A product (ID: ', $args['id'],') was fetched', PHP_EOL;
            echo 'A product does not exist', PHP_EOL;
        } else {
            echo 'A product (ID: ', $success['id'],') was fetched', PHP_EOL;
            echo 'Fetched product -> ID: ', $success['id'], ', NAME: ', $success['name'], ', PRICE: ', $success['price'], PHP_EOL;
        }
    }
    public function update($args) {
        $file = file($this->dbPath . "products" . $this->dbExtension);
        $alreadyFound = false;
        foreach ($file as $row) {
            if (!$row) {
                continue;
            }
            $fields = explode($this->delimiter, $row);
            $product = [
                'id' => $fields[0],
                'name' => $fields[1],
                'price' => $fields[2],
            ];
            if ($product['id'] == $args['id']) {
                $success = $product;
                $successString = implode($this->delimiter, $product);
                $replaceRecord = implode($this->delimiter, $args) . "\r\n";
                $replace = str_replace($successString, $replaceRecord, $file);
                file_put_contents($this->dbPath . "products" . $this->dbExtension, $replace);
                $alreadyFound = true;
                
            }
        }
        if (!$alreadyFound) {
            echo 'A product does not exist', PHP_EOL;
        } else {
            echo 'A product (ID: ', $success['id'],') was updated', PHP_EOL;
            echo 'New product -> ID: ', $args['id'], ', NAME: ', $args['name'], ', PRICE: ', $args['price'], PHP_EOL;
        }
    }
    public function delete($args) {
        $file = file($this->dbPath . "products" . $this->dbExtension);
        $alreadyFound = false;
        foreach ($file as $row) {
            if (!$row) {
                continue;
            }
            $fields = explode($this->delimiter, $row);
            $product = [
                'id' => $fields[0],
                'name' => $fields[1],
                'price' => $fields[2],
            ];
            if ($product['id'] == $args['id']) {
                $success = $product;
                $successString = implode($this->delimiter, $product);
                $replace = str_replace($successString,'', $file);
                file_put_contents($this->dbPath . "products" . $this->dbExtension, $replace);
                $alreadyFound = true;
                
            }
        }
        if (!$alreadyFound) {
            echo 'A product does not exist', PHP_EOL;
        } else {
            echo 'A product (ID: ', $success['id'],') was deleted', PHP_EOL;
            echo 'Deleted product -> ID: ', $success['id'], ', NAME: ', $success['name'], ', PRICE: ', $success['price'], PHP_EOL;
        }
    }
}

class OrdersDB extends Database {
    public function create($args) {
        $file = file($this->dbPath . "orders" . $this->dbExtension);
        $alreadyExists = false;
        foreach ($file as $row) {
            if (!$row) {
                continue;
            }
            $fields = explode($this->delimiter, $row);
            $order = [
                'id' => $fields[0],
                'date' => $fields[1],
                'price' => $fields[2],
            ];
            if ($order['id'] == $args['id']) {
                $alreadyExists = true;
            }
        }
        if (!$alreadyExists) {
            $newRecord = implode($this->delimiter, $args) . "\r\n";
            file_put_contents($this->dbPath . "orders" . $this->dbExtension, $newRecord, FILE_APPEND);
            echo 'Order (ID: ', $args['id'], ', DATE: ', $args['date'], ', PRICE: ', $args['price'], ') was created', PHP_EOL;
        } else {
            echo 'A order already exists', PHP_EOL;
        }
    }
    public function fetch($args) {
        $file = file($this->dbPath . "orders" . $this->dbExtension);
        $alreadyFound = false;
        foreach ($file as $row) {
            if (!$row) {
                continue;
            }
            $fields = explode($this->delimiter, $row);
            $order = [
                'id' => $fields[0],
                'date' => $fields[1],
                'price' => $fields[2],
            ];
            if ($order['id'] == $args['id']) {
                $success = $order;
                $alreadyFound = true;
            }
        }
        if (!$alreadyFound) {
            echo 'A order (ID: ', $args['id'],') was fetched', PHP_EOL;
            echo 'A order does not exist', PHP_EOL;
        } else {
            echo 'A order (ID: ', $success['id'],') was fetched', PHP_EOL;
            echo 'Fetched order -> ID: ', $success['id'], ', DATE: ', $success['date'], ', PRICE: ', $success['price'], PHP_EOL;
        }
    }
    public function update($args) {
        $file = file($this->dbPath . "orders" . $this->dbExtension);
        $alreadyFound = false;
        foreach ($file as $row) {
            if (!$row) {
                continue;
            }
            $fields = explode($this->delimiter, $row);
            $order = [
                'id' => $fields[0],
                'date' => $fields[1],
                'price' => $fields[2],
            ];
            if ($order['id'] == $args['id']) {
                $success = $order;
                $successString = implode($this->delimiter, $order);
                $replaceRecord = implode($this->delimiter, $args) . "\r\n";
                $replace = str_replace($successString, $replaceRecord, $file);
                file_put_contents($this->dbPath . "orders" . $this->dbExtension, $replace);
                $alreadyFound = true;
                
            }
        }
        if (!$alreadyFound) {
            echo 'A order does not exist', PHP_EOL;
        } else {
            echo 'A order (ID: ', $success['id'],') was updated', PHP_EOL;
            echo 'New order -> ID: ', $args['id'], ', DATE: ', $args['date'], ', PRICE: ', $args['price'], PHP_EOL;
        }
    }
    public function delete($args) {
        $file = file($this->dbPath . "orders" . $this->dbExtension);
        $alreadyFound = false;
        foreach ($file as $row) {
            if (!$row) {
                continue;
            }
            $fields = explode($this->delimiter, $row);
            $order = [
                'id' => $fields[0],
                'date' => $fields[1],
                'price' => $fields[2],
            ];
            if ($order['id'] == $args['id']) {
                $success = $order;
                $successString = implode($this->delimiter, $order);
                $replace = str_replace($successString,'', $file);
                file_put_contents($this->dbPath . "orders" . $this->dbExtension, $replace);
                $alreadyFound = true;
                
            }
        }
        if (!$alreadyFound) {
            echo 'A order does not exist', PHP_EOL;
        } else {
            echo 'A order (ID: ', $success['id'],') was deleted', PHP_EOL;
            echo 'Deleted order -> ID: ', $success['id'], ', DATE: ', $success['date'], ', PRICE: ', $success['price'], PHP_EOL;
        }
    }
}
