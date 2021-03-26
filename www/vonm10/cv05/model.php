<?php

interface DatabaseOperations {
    public function create($args);
    public function fetch($args);
    public function save($args);
    public function delete($args);
}
abstract class Database implements DatabaseOperations {
    protected $dbPath = './static/'; 
    protected $dbExtension = '.db';
    protected $delimiter = ';';
    public function __construct() {
        echo '<br>-----', static::class, ' was instantiated-----<br>', PHP_EOL;
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
        $input =
        [
            'id' => $args['id'],
            'name' => $args['name'],
            'age' => $args['age']
        ];

        $file = file($this->dbPath.'users'.$this->dbExtension);
        $isExistingUser = false;

       
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $user =
                    [
                        'id' => $fields[0]
                    ];
        
                if ($user['id'] === $input['id']) {
                    $isExistingUser = true;
                    break;
                }
            }
        
            if ($isExistingUser) {
                echo "<br>User with this id already exists";
            } else {$implodedRecord = implode($this->delimiter, $input) . "\r\n";
                file_put_contents($this->dbPath.'users'.$this->dbExtension, $implodedRecord, FILE_APPEND);
        
                echo '<br>User ', $args['name'], ' age: ', $args['age'], ' was created', PHP_EOL; }

        
    }
    public function fetch($args)  { 
        
        $userId = $args['id'];

        $output =
        [
            $name = '',
            $age = ''
        ];

        $file = file($this->dbPath.'users'.$this->dbExtension);
        $isExistingUser = false;

       
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $user =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'age' => $fields[2],
                    ];
        
                if ($user['id'] === $userId) {
                    $isExistingUser = true;
                    $output['name'] = $user['name'];
                    $output['age'] = $user['age'];
                    break;
                }
            }
        
            if ($isExistingUser) {
                echo "<br>" . $output['name']. ' '. $output['age'];
                echo "<br>". 'A user was fetched', PHP_EOL;
            } else {echo "<br>" . 'User not found';
                echo "<br>". 'User was not fetched', PHP_EOL;}
    
     }

    public function save($args)   
    { 
        $userId = $args['id'];
        $newName = $args['name'];
        $newAge = $args['age'];

        $output =
        [
            $name = '',
            $age = ''
        ];

        $file = file($this->dbPath.'users'.$this->dbExtension);
        $isExistingUser = false;

       
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $user =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'age' => $fields[2],
                    ];
        
                if ($user['id'] === $userId) {
                    $user['name'] = $newName;
                    $user['age'] = $newAge;
                    $output['name'] = $user['name'];
                    $output['age'] = $user['age'];
                    $isExistingUser = true;
                    break;
                }
            }
        
            if ($isExistingUser) {
                $this -> delete(['id' => $userId]);
                $this -> create(['id' => $userId, 'name' => $output['name'], 'age' => $output['age']]);
                echo "<br>" . $output['name']. ' '. $output['age'];
                echo "<br>". 'A user was updated', PHP_EOL;
            } else {echo "<br>" . 'User not found';
                echo "<br>". 'User was not updated', PHP_EOL;}

    }
    public function delete($args) 
    {
        $userId = $args['id'];
        $output =
        [
            $name = '',
            $age = ''
        ];

        $file = file($this->dbPath.'users'.$this->dbExtension);
        $isExistingUser = false;

       
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $user =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'age' => $fields[2],
                    ];
        
                if ($user['id'] === $userId) {
                    $output['name'] = $user['name'];
                    $output['age'] = $user['age'];
                    $isExistingUser = true;
                    $replace = str_replace($record,'',$file);
                    file_put_contents($this->dbPath.'users'.$this->dbExtension,$replace);
                    break;
                }
            }
        
            if ($isExistingUser) {
                echo "<br>" . $output['name']. ' '. $output['age'];
                echo '<br> A user was deleted', PHP_EOL;
            } else {echo "<br>" . 'User not found';
                echo '<br> User was not deleted', PHP_EOL; }

        
    }
}

class ProductsDB extends Database {
    public function create($args) { 
        $input =
        [
            'id' => $args['id'],
            'name' => $args['name'],
            'price' => $args['price']
        ];

        $file = file($this->dbPath.'products'.$this->dbExtension);
        $isExistingProduct = false;

        if(!empty($file)){
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $product =
                    [
                        'id' => $fields[0]
                    ];
        
                if ($product['id'] === $input['id']) {
                    $isExistingProduct = true;
                    break;
                }
            }
        }
        
            if ($isExistingProduct) {
                echo "Product with this id already exists";
            } else {$implodedRecord = implode($this->delimiter, $input) . "\r\n";
                file_put_contents($this->dbPath.'products'.$this->dbExtension, $implodedRecord, FILE_APPEND);
        
                echo '<br>Product ', $args['name'], ' price: ', $args['price'], ' was created', PHP_EOL; }

        
    }
    public function fetch($args)  { 
        
        $productId = $args['id'];

        $output =
        [
            $name = '',
            $price = ''
        ];

        $file = file($this->dbPath.'products'.$this->dbExtension);
        $isExistingProduct = false;

       
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $product =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'price' => $fields[2],
                    ];
        
                if ($product['id'] === $productId) {
                    $isExistingProduct = true;
                    $output['name'] = $product['name'];
                    $output['price'] = $product['price'];
                    break;
                }
            }
        
            if ($isExistingProduct) {
                echo "<br>" . $output['name']. ' '. $output['price'];
                echo "<br>". 'A product was fetched', PHP_EOL;
            } else {echo "<br>" . 'Product not found';
                echo "<br>". 'Product was not fetched', PHP_EOL;}
    
     }

    public function save($args)   
    { 
        $productId = $args['id'];
        $newName = $args['name'];
        $newPrice = $args['price'];

        $output =
        [
            $name = '',
            $price = ''
        ];

        $file = file($this->dbPath.'products'.$this->dbExtension);
        $isExistingProduct = false;

       
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $product =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'price' => $fields[2],
                    ];
        
                if ($product['id'] === $productId) {
                    $product['name'] = $newName;
                    $product['price'] = $newPrice;
                    $output['name'] = $product['name'];
                    $output['price'] = $product['price'];
                    $isExistingProductg = true;
                    break;
                }
            }
        
            if ($isExistingProduct) {
                $this -> delete(['id' => $productId]);
                $this -> create(['id' => $productId, 'name' => $output['name'], 'price' => $output['price']]);
                echo "<br>" . $output['name']. ' '. $output['price'];
                echo "<br>". 'A product was updated', PHP_EOL;
            } else {echo "<br>" . 'Product not found';
                echo "<br>". 'Product was not updated', PHP_EOL;}

    }
    public function delete($args) 
    {
        $productId = $args['id'];
        $output =
        [
            $name = '',
            $price = ''
        ];

        $file = file($this->dbPath.'products'.$this->dbExtension);
        $isExistingProduct = false;

       
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $product =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'price' => $fields[2],
                    ];
        
                if ($product['id'] === $productId) {
                    $output['name'] = $product['name'];
                    $output['price'] = $product['price'];
                    $isExistingProduct = true;
                    $replace = str_replace($record,'',$file);
                    file_put_contents($this->dbPath.'products'.$this->dbExtension,$replace);
                    break;
                }
            }
        
            if ($isExistingProduct) {
                echo "<br>" . $output['name']. ' '. $output['price'];
                echo '<br> A product was deleted', PHP_EOL;
            } else {echo "<br>" . 'Product not found';
                echo '<br> Product was not deleted', PHP_EOL; }

        
    }
}


class OrdersDB extends Database {
public function create($args) { 
        $input =
        [
            'id' => $args['id'],
            'date' => $args['date']
        ];

        $file = file($this->dbPath.'orders'.$this->dbExtension);
        $isExistingOrder = false;

       
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $order =
                    [
                        'id' => $fields[0]
                    ];
        
                if ($order['id'] === $input['id']) {
                    $isExistingOrder = true;
                    break;
                }
            }
        
            if ($isExistingOrder) {
                echo "<br>Order with this id already exists";
            } else {$implodedRecord = implode($this->delimiter, $input) . "\r\n";
                file_put_contents($this->dbPath.'orders'.$this->dbExtension, $implodedRecord, FILE_APPEND);
        
                echo '<br>Order '. $args['id'] . " " . $args['date'] . ' was created', PHP_EOL; }

        
    }
    public function fetch($args)  { 
        
        $orderId = $args['id'];

        $output =
        [
            $number = '',
            $date = ''
        ];

        $file = file($this->dbPath.'orders'.$this->dbExtension);
        $isExistingOrder = false;

       
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $order =
                    [
                        'id' => $fields[0],
                        'date' => $fields[1]
                    ];
        
                if ($order['id'] === $orderId) {
                    $isExistingOrder = true;
                    $output['number'] = $order['id'];
                    $output['date'] = $order['date'];
                    break;
                }
            }
        
            if ($isExistingOrder) {
                echo "<br>" . $output['number'] . " " . $output['date'];
                echo "<br>". 'An order was fetched', PHP_EOL;
            } else {echo "<br>" . 'Order not found';
                echo "<br>". 'Order was not fetched', PHP_EOL;}
    
     }

    public function save($args)   
    { 
        $orderId = $args['id'];
        $newDate = $args['date'];

        $output =
        [
            $number = '',
            $date = ''
        ];

        $file = file($this->dbPath.'orders'.$this->dbExtension);
        $isExistingOrder = false;

       
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $order =
                    [
                        'id' => $fields[0],
                        'date' => $fields[1]
                    ];
        
                if ($order['id'] === $orderId) {
                    $order['date'] = $newDate;
                    $output['number'] = $order['id'];
                    $output['date'] = $order['date'];
                    $isExistingOrder = true;
                    break;
                }
            }
        
            if ($isExistingOrder) {
                $this -> delete(['id' => $orderId]);
                $this -> create(['id' => $orderId, 'date' => $newDate]);
                echo "<br>" . $output['number'] . " " . $output['date'];
                echo "<br>". 'An order was updated', PHP_EOL;
            } else {echo "<br>" . 'Order not found';
                echo "<br>". 'Order was not updated', PHP_EOL;}

    }
    public function delete($args) 
    {
        $orderId = $args['id'];
        $output =
        [
            $number = '',
            $date = ''
        ];

        $file = file($this->dbPath.'orders'.$this->dbExtension);
        $isExistingOrder = false;

       
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $order =
                    [
                        'id' => $fields[0],
                        'date' => $fields[1]
                    ];
        
                if ($order['id'] === $orderId) {
                    $output['number'] = $order['id'];
                    $output['date'] = $order['date'];
                    $isExistingOrder = true;
                    $replace = str_replace($record,'',$file);
                    file_put_contents($this->dbPath.'orders'.$this->dbExtension,$replace);
                    break;
                }
            }
        
            if ($isExistingOrder) {
                echo "<br>" . $output['number'] . " " . $output['date'];
                echo '<br> An order was deleted', PHP_EOL;
            } else {echo "<br>" . 'Order not found';
                echo '<br> Order was not deleted', PHP_EOL; }

        
    }
}
