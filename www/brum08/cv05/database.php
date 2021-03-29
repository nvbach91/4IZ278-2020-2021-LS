<?php
interface DatabaseOperations
{
    public function create($line);
    public function fetch();
    public function save($line);
    public function delete($line);
}

abstract class Database implements DatabaseOperations
{
    protected $dbPath = __DIR__ . '/db/';
    protected $dbExtension = '.db';
    protected $delimiter = ';';

    public function __construct()
    {
        echo '<br>-----', static::class, ' was instantiated-----<br>', PHP_EOL;
    }
    public function __toString()
    {
        return "database config: dbPath: $this->dbPath, dbExtenstion: $this->dbExtension, delimiter: $this->delimiter";
    }
}

class OrdersDB extends Database {
    public function create($args) { 
            $input =
            [
                'id' => $args['id'],
                'item' => $args['item']
            ];
    
            $file = file($this->dbPath.'Orders'.$this->dbExtension);
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
                    echo "<br>Order already exists";
                } else {
                    $implodedRecord = implode($this->delimiter, $input) . "\r\n";
                    file_put_contents($this->dbPath.'Orders'.$this->dbExtension, $implodedRecord, FILE_APPEND);
    
                    echo '<br>Order '. $args['id'] . " " . $args['item'] . ' was created', PHP_EOL; }
    
    
        }
        public function fetch()  { 
            $file = file($this->dbPath.'Orders'.$this->dbExtension);
            echo '<br>Záznamy tabulky:';
    
                foreach ($file as $record) {
                    if (!$record) {
                        echo 'No lines to show'."<br>";
                    }
                    echo "<br>". $record;
                }
         }
    
        public function save($args)   
        { 
            $orderId = $args['id'];
            $newItem = $args['item'];
            $updatedFile = [];
    
    
            $file = file($this->dbPath.'Orders'.$this->dbExtension);
            $bFoundOrder = false;
    
    
                foreach ($file as $record) {
                    if (!$record) {
                        continue;
                    }
                    $fields = explode(';', $record);
                    $order =
                        [
                            'id' => $fields[0],
                            'item' => $fields[1]
                        ];
    
                    if ($order['id'] === $orderId) {
                        $order['item'] = $newItem;
                        $implodedRecord = implode($this->delimiter, $order) . "\r\n";
                        array_push($updatedFile,$implodedRecord);
                        $bFoundOrder = true;
                    }else{
                        array_push($updatedFile,$record);
                    }
                }
    
                if ($bFoundOrder) {
                    file_put_contents($this->dbPath.'Orders'.$this->dbExtension, '');
                    foreach($updatedFile as $line){
                        file_put_contents($this->dbPath.'Orders'.$this->dbExtension, $line, FILE_APPEND);
                    }
                    echo "<br>". 'An order was updated', PHP_EOL;
                } else {echo "<br>" . 'Order not found';
                    echo "<br>". 'Order was not updated', PHP_EOL;}
    
        }
        public function delete($args) 
        {
            $orderId = $args['id'];
            $updatedFile = [];
            
            $file = file($this->dbPath.'Orders'.$this->dbExtension);
            $bDeleted = false;
    
    
                foreach ($file as $record) {
                    if (!$record) {
                        continue;
                    }
                    $fields = explode(';', $record);
                    $order =
                        [
                            'id' => $fields[0],
                            'item' => $fields[1]
                        ];
    
                    if ($order['id'] === $orderId) {
                        $bDeleted = true;
                    }else{
                        array_push($updatedFile,$record);
                    }
                }
    
                if ($bDeleted) {
                    file_put_contents($this->dbPath.'Orders'.$this->dbExtension, '');
                    foreach($updatedFile as $line){
                        file_put_contents($this->dbPath.'Orders'.$this->dbExtension, $line, FILE_APPEND);
                    }
                    echo '<br> An order was deleted', PHP_EOL;
                } else {echo "<br>" . 'Order not found';
                    echo '<br> Order was not deleted', PHP_EOL; }
    
    
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
        
                $file = file($this->dbPath.'Products'.$this->dbExtension);
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
                        echo "<br>Product already exists";
                    } else {$implodedRecord = implode($this->delimiter, $input) . "\r\n";
                        file_put_contents($this->dbPath.'Products'.$this->dbExtension, $implodedRecord, FILE_APPEND);
        
                        echo '<br>Product '. $args['id'] . " " . $args['name'] . " " . $args['price'] .' was created', PHP_EOL; }
        
        
            }
            public function fetch()  { 
                $file = file($this->dbPath.'Products'.$this->dbExtension);
                echo '<br>Záznamy tabulky:';
        
                    foreach ($file as $record) {
                        if (!$record) {
                            echo 'No lines to show'."<br>";
                        }
                        echo "<br>". $record;
                    }
             }
        
            public function save($args)   
            { 
                $orderId = $args['id'];
                $newName = $args['name'];
                $newPrice = $args['price'];
                $updatedFile = [];
        
        
                $file = file($this->dbPath.'Products'.$this->dbExtension);
                $bFoundOrder = false;
        
        
                    foreach ($file as $record) {
                        if (!$record) {
                            continue;
                        }
                        $fields = explode(';', $record);
                        $order =
                            [
                                'id' => $fields[0],
                                'name' => $fields[1],
                                'price' => $fields[2]
                            ];
        
                        if ($order['id'] === $orderId) {
                            $order['name'] = $newName;
                            $order['price'] = $newPrice;
                            $implodedRecord = implode($this->delimiter, $order) . "\r\n";
                            array_push($updatedFile,$implodedRecord);
                            $bFoundOrder = true;
                        }else{
                            array_push($updatedFile,$record);
                        }
                    }
        
                    if ($bFoundOrder) {
                        file_put_contents($this->dbPath.'Products'.$this->dbExtension, '');
                        foreach($updatedFile as $line){
                            file_put_contents($this->dbPath.'Products'.$this->dbExtension, $line, FILE_APPEND);
                        }
                        echo "<br>". 'Product was updated', PHP_EOL;
                    } else {echo "<br>" . 'Product not found';
                        echo "<br>". 'Product was not updated', PHP_EOL;}
        
            }
            public function delete($args) 
            {
                $orderId = $args['id'];
                $updatedFile = [];
                
                $file = file($this->dbPath.'Products'.$this->dbExtension);
                $bDeleted = false;
        
        
                    foreach ($file as $record) {
                        if (!$record) {
                            continue;
                        }
                        $fields = explode(';', $record);
                        $order =
                            [
                                'id' => $fields[0],
                                'name' => $fields[1],
                                'price' => $fields[2]
                            ];
        
                        if ($order['id'] === $orderId) {
                            $bDeleted = true;
                        }else{
                            array_push($updatedFile,$record);
                        }
                    }
        
                    if ($bDeleted) {
                        file_put_contents($this->dbPath.'Products'.$this->dbExtension, '');
                        foreach($updatedFile as $line){
                            file_put_contents($this->dbPath.'Products'.$this->dbExtension, $line, FILE_APPEND);
                        }
                        echo '<br> Product was deleted', PHP_EOL;
                    } else {echo "<br>" . 'Product not found';
                        echo '<br> Product was not deleted', PHP_EOL; }
        
        
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
            
                    $file = file($this->dbPath.'Users'.$this->dbExtension);
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
                            echo "<br>User already exists";
                        } else {$implodedRecord = implode($this->delimiter, $input) . "\r\n";
                            file_put_contents($this->dbPath.'Users'.$this->dbExtension, $implodedRecord, FILE_APPEND);
            
                            echo '<br>User '. $args['id'] . " " . $args['name'] . " " . $args['age'] .' was created', PHP_EOL; }
            
            
                }
                public function fetch()  { 
                    $file = file($this->dbPath.'Users'.$this->dbExtension);
                    echo '<br>Záznamy tabulky:';
            
                        foreach ($file as $record) {
                            if (!$record) {
                                echo 'No lines to show'."<br>";
                            }
                            echo "<br>". $record;
                        }
                 }
            
                public function save($args)   
                { 
                    $orderId = $args['id'];
                    $newName = $args['name'];
                    $newPrice = $args['age'];
                    $updatedFile = [];
            
            
                    $file = file($this->dbPath.'Users'.$this->dbExtension);
                    $bFoundOrder = false;
            
            
                        foreach ($file as $record) {
                            if (!$record) {
                                continue;
                            }
                            $fields = explode(';', $record);
                            $order =
                                [
                                    'id' => $fields[0],
                                    'name' => $fields[1],
                                    'age' => $fields[2]
                                ];
            
                            if ($order['id'] === $orderId) {
                                $order['name'] = $newName;
                                $order['age'] = $newPrice;
                                $implodedRecord = implode($this->delimiter, $order) . "\r\n";
                                array_push($updatedFile,$implodedRecord);
                                $bFoundOrder = true;
                            }else{
                                array_push($updatedFile,$record);
                            }
                        }
            
                        if ($bFoundOrder) {
                            file_put_contents($this->dbPath.'Users'.$this->dbExtension, '');
                            foreach($updatedFile as $line){
                                file_put_contents($this->dbPath.'Users'.$this->dbExtension, $line, FILE_APPEND);
                            }
                            echo "<br>". 'User was updated', PHP_EOL;
                        } else {echo "<br>" . 'User not found';
                            echo "<br>". 'User was not updated', PHP_EOL;}
            
                }
                public function delete($args) 
                {
                    $orderId = $args['id'];
                    $updatedFile = [];
                    
                    $file = file($this->dbPath.'Users'.$this->dbExtension);
                    $bDeleted = false;
            
            
                        foreach ($file as $record) {
                            if (!$record) {
                                continue;
                            }
                            $fields = explode(';', $record);
                            $order =
                                [
                                    'id' => $fields[0],
                                    'name' => $fields[1],
                                    'age' => $fields[2]
                                ];
            
                            if ($order['id'] === $orderId) {
                                $bDeleted = true;
                            }else{
                                array_push($updatedFile,$record);
                            }
                        }
            
                        if ($bDeleted) {
                            file_put_contents($this->dbPath.'Users'.$this->dbExtension, '');
                            foreach($updatedFile as $line){
                                file_put_contents($this->dbPath.'Users'.$this->dbExtension, $line, FILE_APPEND);
                            }
                            echo '<br> User was deleted', PHP_EOL;
                        } else {echo "<br>" . 'User not found';
                            echo '<br> User was not deleted', PHP_EOL; }
            
            
                }
            }
