<?php

interface DatabaseOperations {
    // note that these methods have no body
    // where are their bodies?
    public function fetch($arg);
    public function create($args);
    public function save($id,$array);
    public function delete($arg);
}
 
abstract class Database implements DatabaseOperations {
    // why is protected used here?
    protected $dbPath = 'db/';
    protected $delimiter = ';';

    protected $configuration;
    protected $dbExtension = '.db';
    protected $idCount;

    public function __construct($dbName ) {
        $this -> idCount = 1;
        // what is static::class?
        $this -> configuration = 'db/'. $dbName . '.db';
        file_put_contents($this -> configuration,'');
        echo '-----', static::class, ' was instantiated-----', '<br>';
    }
    // this will get returned when one tries to stringify the instance with i.e. echo
    public function __toString(): string
    {
        return "database config: dbPath: $this->dbPath, dbExtenstion: $this->dbExtension, delimiter: $this->delimiter";
    }
    public function configInfo() {
        echo $this;
    }
    protected function addLineCSV($args) {
        $appendText = strval($this->idCount).';';

        //var_dump($args);
        foreach($args as $arg){
            $appendText = $appendText.strval($arg). ';';
        }

        $appendText = substr_replace($appendText ,"", -1);
        if( $this -> idCount == 1)
            file_put_contents( $this -> configuration,"$appendText",FILE_APPEND);
        else
            file_put_contents( $this -> configuration,"\r\n"."$appendText",FILE_APPEND);
    }
    protected function findLine($keyword, $row): ?array
    {

        $data = $this -> loadDatabase();

        foreach($data as  $a){

            if($a[$row] === strval($keyword)) {

                return $a;
            }

        }
        return NULL;
    }
    protected function deleteLine($user){
        $id = intval($user[0]);

        $others = array_filter($this->loadDatabase(), function ($item) use ($id) { return $item[0] != $id; });
        $this->storeDatabase(array_values($others));
    }
    protected function storeDatabase(array $data): void {
        $file = $this ->configuration;
        $serialized = array_map(
            function ($row) {
                return implode(';', $row);
            },
            $data
        );

        file_put_contents($file, implode("\n", $serialized));
    }
    protected function loadDatabase(): array {
        $file = $this -> configuration;
        $content = file_get_contents($file);
        $lines = explode("\n", $content);
        return array_map(
            function ($line) {
                return explode(';', $line);
            },
            $lines
        );
    }
    protected function changeAtr($line, $parameters) {
        $users = $this->loadDatabase();

        foreach ($users as $index => $user) {
            //var_dump($user);
            if ($user[0] == $line) {
                $users[$index] = $parameters;
            }
        }
        //var_dump($users);
        $this->storeDatabase($users);
    }
}
class UsersDB extends Database  {

    public function create($args) { 
        $this -> addLineCSV($args);
        $this -> idCount ++;
        echo 'User ', $args['name'], ' age: ', $args['age'], ' was created', '<br>';
    }
    public function fetch($arg)  {
        if (is_integer($arg))
            $user = $this -> findLine($arg,0);
        else
            $user = $this -> findLine($arg,1);
        if($user == NULL) echo "User not found", '<br>';
        else echo "A user was fetched id:$user[0] name:$user[1] age:$user[2]", '<br>';
        }
    public function save($id,$array)
    {
        $user = $this -> findLine($id,0);
        if($user == NULL) echo "User not found", '<br>';
        else{
            $this-> changeAtr($id,$array);
            echo 'A user was saved  ', '<br>';
        }
    }
    public function delete($arg) {
        if (is_integer($arg))
            $user = $this -> findLine($arg,0);
        else
            $user = $this -> findLine($arg,1);

        if($user == NULL) echo "User not found". '<br>';
        else{
            $this -> deleteLine($user);
            echo 'A user was deleted', '<br>';
        }
        
    }
}
class ProductsDB extends Database
{
    public function create($args)
    {
        $this->addLineCSV($args);
        $this->idCount++;
        echo 'Product ', $args['name'], ' price: ', $args['price'], ' was created', '<br>';
    }

    public function fetch($arg)
    {
        if (is_integer($arg))
            $user = $this->findLine($arg, 0);
        else
            $user = $this->findLine($arg, 1);
        if ($user == NULL) echo "Product not found", '<br>';
        else echo "A product was fetched id:$user[0] name:$user[1] price:$user[2]", '<br>';
    }

    public function save($id, $array)
    {
        $user = $this->findLine($id, 0);
        if ($user == NULL) echo "Product not found", '<br>';
        else {
            $this->changeAtr($id, $array);
            echo 'A product was saved  ', '<br>';
        }
    }

    public function delete($arg)
    {
        if (is_integer($arg))
            $user = $this->findLine($arg, 0);
        else
            $user = $this->findLine($arg, 1);

        if ($user == NULL) echo "Product not found" . '<br>';
        else {
            $this->deleteLine($user);
            echo 'A product was deleted', '<br>';

        }
    }
}
class OrdersDB extends Database {
    public function create($args)
    {
        $this->addLineCSV($args);
        $this->idCount++;
        echo 'Order ', $args['number'], ' date: ', $args['date'], ' was created', '<br>';
    }

    public function fetch($arg)
    {
        if (is_integer($arg))
            $user = $this->findLine($arg, 0);
        else
            $user = $this->findLine($arg, 1);
        if ($user == NULL) echo "Product not found", '<br>';
        else echo "A order was fetched  number:$user[1] date:$user[2]", '<br>';
    }

    public function save($id, $array)
    {
        $user = $this->findLine($id, 0);
        if ($user == NULL) echo "Order not found", '<br>';
        else {
            $this->changeAtr($id, $array);
            echo 'A order was saved  ', '<br>';
        }
    }

    public function delete($arg)
    {
        if (is_integer($arg))
            $user = $this->findLine($arg, 0);
        else
            $user = $this->findLine($arg, 1);

        if ($user == NULL) echo "Order not found" . '<br>';
        else {
            $this->deleteLine($user);
            echo 'A order was deleted', '<br>';

        }
    }
}

//users
$users = new UsersDB('users');
$users->create(['name' => 'Dave Fwgwgw', 'age' => 33]);
$users->fetch(1);
$users->create(['name' => 'Dave HDSfadfaf', 'age' => 15]);
$users->save(2,['id'=>2,'name' => 'Dave Faggu', 'age' => 42]);
$users->delete(1);
$users->delete(2);
//products
$products = new ProductsDB('products');
$products->create(['name' => 'Broom of Harry', 'price' => 4500]);
$products->create(['name' => 'Wand of Albuss', 'price' => 7690]);
$products->fetch(1);
$products->fetch('Wand of Albuss');
$products->save(2,['id'=>2,'name' => 'Wand of Flbuss', 'price' => 9999]);
$products->delete(1);
$products->delete(2);

//orders
$orders = new OrdersDB('orders');
$orders->create(['number' => 42, 'date' => '2019-03-08']);
$orders->save(1,['id'=>1,'number' => 69, 'date' => '2019-12-08']);
$orders->fetch(1);
$orders->delete(1);

?>

