<?php

    interface DatabaseOperations {
        public function create($arg);
        public function fetch($arg);
        public function save($arg);
        public function delete($arg);
}   

    abstract class Database implements DatabaseOperations {
        protected $dbPath = './database/'; 
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
        public function create($arg){
            $input = [
                'name' => $arg['name'],
                'mail' => $arg['mail'],
                'age' => $arg['age']
            ];
            $file = file($this->dbPath.'users'.$this->dbExtension);
            $isExistingUser = false;

            foreach($file as $line){
                if (!$line) {
                    continue;
                }
                $fields = explode(';', $line);
                $user =
                    [
                        'mail' => $fields[1]
                    ];

                if ($user['mail'] === $input['mail']) {
                    $isExistingUser = true;
                    break;
                }
            }
        
            if(!$isExistingUser){
        
                $userInfo = [
                    $arg['name'],
                    $arg['mail'],
                    $arg['age'],
                ];
                //vyrobit záznam 
                $newRecord = implode(';', $userInfo) . "\r\n";
        
            //vložit do souboru
                file_put_contents($this->dbPath.'users'.$this->dbExtension, $newRecord, FILE_APPEND);
                echo $arg['name'].' ('.$arg['age'] .') přidán do databáze! <br>';
            }
        }
        public function fetch($arg){
            $file = file($this->dbPath.'users'.$this->dbExtension);
            $isExistingUser = false;
            foreach($file as $line){
                if (!$line) {
                    continue;
                }
                $fields = explode(';', $line);
                $user =
                    [
                        'name' => $fields[0],
                        'mail' => $fields[1],
                        'age' => $fields[2],
                    ];

                if ($user['mail'] === $arg) {
                    $isExistingUser = true;
                    break;
                }
            }
            if($isExistingUser){
                echo "Hledáte: ". $user['name'] ." (" .$user['age'].") - Máme ho v databázi <br>";
            }else{
                echo "Uživatel s mailem: " . $arg . " nebyl v db nalezen. <br>";
            }
            
        }
        public function save($arg){
            $input = [
                'name' => $arg['name'],
                'mail' => $arg['mail'],
                'age' => $arg['age']
            ];
            $file = file($this->dbPath.'users'.$this->dbExtension);
            $sameUser = false;

            foreach($file as $line){
                if (!$line) {
                    continue;
                }
                $fields = explode(';', $line);
                $user =
                    [
                        'name' => $fields[0],
                        'mail' => $fields[1],
                        'age' => $fields[2],
                    ];

                if ($user['mail'] === $input['mail']) {
                    $user['name'] = $input['name'];
                    $user['age'] = $input['age'];
                    $sameUser = true;
                    break;
                }
            }
        
            if(!$sameUser){
                echo "uživatel nebyl v db nalezen, proto jej vytvoříme! <br>";
                $this -> create($arg);
            }else{
                echo "Uživatel ". $arg['name'] ." upraven! <br>";
            }
        }
        public function delete($arg){
            $file = file($this->dbPath.'users'.$this->dbExtension);
            $isExistingUser = false;
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $user =
                    [
                        'name' => $fields[0],
                        'mail' => $fields[1],
                        'age' => $fields[2],
                    ];

                if ($user['mail'] === $arg) {
                    $user['name'] = '';
                    $user['age'] = '';
                    $isExistingUser = true;
                    $replace = str_replace($record,'',$file);
                    file_put_contents($this->dbPath.'users'.$this->dbExtension,$replace);
                    break;
                }
            }
            if($isExistingUser){
                echo "Uživatel s mailem $arg byl odstraněn z databáze! <br>";
            }
        }
    }

    class ProductsDB extends Database {
        public function create($arg){
             $input = [
                'id' => $arg['id'],
                'name' => $arg['name'],
                'price' => $arg['price']
             ];
             $file = file($this->dbPath.'products'.$this->dbExtension);
             $isExistingProduct = false;
    
             foreach($file as $line){
                if (!$line) {
                    continue;
                }
                $fields = explode(';', $line);
                $product =
                    [
                        'id' => $fields[0]
                    ];
    
                if ($product['id'] == $input['id']) {
                    $isExistingProduct = true;
                    echo "Produkt již existuje <br>";
                    break;
                }
            }
        
            if(!$isExistingProduct){
        
                $productInfo = [
                    $arg['id'],
                    $arg['name'],
                    $arg['price'],
                ];
                //vyrobit záznam 
                $newRecord = implode(';', $productInfo) . "\r\n";
        
            //vložit do souboru
                file_put_contents($this->dbPath.'products'.$this->dbExtension, $newRecord, FILE_APPEND);
                echo $arg['name'].' ('.$arg['price'] .' $) přidán do databáze! <br>';
            }
        }
        public function fetch($arg){
            $file = file($this->dbPath.'products'.$this->dbExtension);
            $isExistingProduct = false;
            foreach($file as $line){
                if (!$line) {
                    continue;
                }
                $fields = explode(';', $line);
                $product =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'price' => $fields[2],
                    ];
    
                if ($product['id'] === $arg) {
                    $isExistingProduct = true;
                    break;
                }
            }
            if($isExistingProduct){
                echo "Hledáte: ". $product['name'] ." - Máme ho v databázi za " .$product['price']." $ <br>";
            }else{
                echo "Produkt s ID: " . $arg . " nebyl v db nalezen. <br>";
            }
            
        }
        public function save($arg){
            $input = [
                'id' => $arg['id'],
                'name' => $arg['name'],
                'price' => $arg['price']
             ];
             $file = file($this->dbPath.'products'.$this->dbExtension);
             $sameProduct = false;
    
             foreach($file as $line){
                if (!$line) {
                    continue;
                }
                $fields = explode(';', $line);
                $product =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'price' => $fields[2],
                    ];
    
                if ($product['id'] == $input['id']) {
                    $product['name'] = $input['name'];
                    $product['price'] = $input['price'];
                    $sameProduct = true;
                    break;
                }
            }
        
            if(!$sameProduct){
                echo "produkt nebyl v db nalezen, proto jej vytvoříme! <br>";
                $this -> create($arg);
            }else{
                echo "Produkt ". $arg['name'] ." upraven! <br>";
            }
        }
        public function delete($arg){
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
    
                if ($product['id'] == $arg) {
                    $product['name'] = '';
                    $product['price'] = '';
                    $isExistingProduct = true;
                    $replace = str_replace($record,'',$file);
                    file_put_contents($this->dbPath.'products'.$this->dbExtension,$replace);
                    break;
                }
            }
            if($isExistingProduct){
                echo "Produkt s ID $arg byl odstraněn z databáze! <br>";
            }
        }
    }

    class OrdersDB extends Database {
        public function create($arg){
             $input = [
                'id' => $arg['id'],
                'name' => $arg['name'],
                'date' => $arg['date']
             ];
             $file = file($this->dbPath.'orders'.$this->dbExtension);
             $isExistingOrder = false;
    
             foreach($file as $line){
                if (!$line) {
                    continue;
                }
                $fields = explode(';', $line);
                $order =
                    [
                        'id' => $fields[0]
                    ];
    
                if ($order['id'] === $input['id']) {
                    $isExistingOrder = true;
                    break;
                }
            }
            if(!$isExistingOrder){
        
                $orderInfo = [
                    $arg['id'],
                    $arg['name'],
                    $arg['date'],
                ];
                //vyrobit záznam 
                $newRecord = implode(';', $orderInfo) . "\r\n";
        
            //vložit do souboru
                file_put_contents($this->dbPath.'orders'.$this->dbExtension, $newRecord, FILE_APPEND);
                echo $arg['id'].': '.$arg['name'] .' - přidána do databáze! <br>';
            }
        }
        public function fetch($arg){
            $file = file($this->dbPath.'orders'.$this->dbExtension);
            $isExistingOrder = false;
            foreach($file as $line){
                if (!$line) {
                    continue;
                }
                $fields = explode(';', $line);
                $order =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'date' => $fields[2],
                    ];
    
                if ($order['id'] == $arg) {
                    $isExistingOrder = true;
                    break;
                }
            }
            if($isExistingOrder){
                echo "Hledáte: ID ". $order['id'] ." z " .$order['date']." - Už na ní pracujeme<br>";
            }else{
                echo "Objednávka s ID " . $arg . " nebyla v db nalezena. <br>";
            }
            
        }
        public function save($arg){
            $input = [
                'id' => $arg['id'],
                'name' => $arg['name'],
                'date' => $arg['date']
             ];
             $file = file($this->dbPath.'orders'.$this->dbExtension);
             $sameOrder = false;
    
             foreach($file as $line){
                if (!$line) {
                    continue;
                }
                $fields = explode(';', $line);
                $order =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'date' => $fields[2],
                    ];
    
                if ($order['id'] == $input['id']) {
                    $order['name'] = $arg['name'];
                    $order['date'] = $arg['date'];
                    $sameOrder = true;
                    break;
                }
            }
        
            if(!$sameOrder){
                echo "Objednávka nebyla v db nalezen, proto ji vytvoříme! <br>";
                $this -> create($arg);
            }else{
                echo "Objednávka ". $arg['name'] ." upravena! <br>";
            }
        }
        public function delete($arg){
            $file = file($this->dbPath.'orders'.$this->dbExtension);
            $sameOrder = false;
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $order =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'date' => $fields[2],
                    ];
    
                if ($order['id'] == $arg) {
                    $order['name'] = '';
                    $order['date'] = '';
                    $sameOrder = true;
                    $replace = str_replace($record,'',$file);
                    file_put_contents($this->dbPath.'orders'.$this->dbExtension,$replace);
                    break;
                }
            }
            if($sameOrder){
                echo "Objednávka s ID $arg byla odstraněna z databáze! <br>";
            }
        }

    }
?>