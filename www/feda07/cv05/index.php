<?php

interface DatabaseOperations
{
    public function create($args);

    public function fetch(int $id);

    public function save();

    public function delete(int $id);
}

abstract class Database implements DatabaseOperations
{
    protected $extension = ".db";
    protected $dbPath = __DIR__ ."/database";
    protected $separator = ";";
    protected $entities = array();

    public function __construct()
    {
        echo '-----', static::class, ' was instantiated-----', '</br>';
    }

    abstract public function getTableName(): string;

    public function create($args)
    {
        array_push($this->entities, $args);
    }

    public function fetch(int $id)
    {
        $databaseFileName = $this->getFile();
        $records = file($databaseFileName);
        $isExisting = false;
        foreach ($records as $record) {
            if (!$record) {
                continue;
            }
            $record = trim($record);
            $fields = explode($this->separator, $record);
            if ($fields[0] == $id)
                $isExisting = true;
        }

        return $isExisting;

    }

    public function save()
    {


        $this->clearFile();
        foreach ($this->entities as $data) {

            $this->writeToFile($data);
        }

    }

    public function delete(int $id)
    {
        $databaseFileName = $this->getFile();
        $records = file($databaseFileName);
        $entities = [];

        foreach ($records as $record) {
            if (!$record) {
                continue;
            }
            $record = trim($record);
            $fields = explode(';', $record);
            if ((intval($fields[0])) != $id) {
                array_push($entities, $fields);
            }

        }

        $this->clearFile();
        foreach ($entities as $data) {
            $this->writeToFile($data);
        }
    }

    protected function writeToFile($data)
    {
        $file = fopen($this->getFile(), 'a');
        fputcsv($file, $data, $this->separator);
        fclose($file);

    }

    protected function clearFile()
    {
        $file = fopen($this->getFile(), 'w');
        fclose($file);
    }


    private function getFile(): string
    {

        $databaseFileName = "$this->dbPath/" . $this->getTableName() . "$this->extension";
        if (!file_exists($databaseFileName)) {
            touch($databaseFileName);

        }
        return $databaseFileName;
    }
}

class UsersDb extends Database
{


    private $dbFile;


    public function __construct()
    {
        parent::__construct();
        $this->dbFile = 'User';
    }

    public function getTableName(): string
    {
        return $this->dbFile;
    }

    public function create($args)
    {
        parent::create($args);
        echo "$this->dbFile ", $args['id'], ': ', $args['name'], ' age: ', $args['age'], ' gender: ', $args['gender'], ' was created', '</br>';
    }

    public function fetch(int $id)
    {
        $isExisting = parent::fetch($id);
        if ($isExisting == true)
            echo "$this->dbFile ", $id, ' was fetched', '</br>';
        else
            echo "$this->dbFile ", $id, ' was not fetched', '</br>';
    }

    public function save()
    {
        parent::save();
        echo "$this->dbFile ", ' was saved', '</br>';
    }

    public function delete(int $id)
    {
        parent::delete($id);
        echo "$this->dbFile ", $id, ' was deleted', '</br>';
    }


}

class ProductsDb extends Database
{


    private $dbFile;


    public function __construct()
    {
        parent::__construct();
        $this->dbFile = 'Product';
    }

    public function getTableName(): string
    {
        return $this->dbFile;
    }

    public function create($args)
    {
        parent::create($args);
        echo "$this->dbFile ", $args['id'], ': ', $args['name'], ' price is $', $args['price'], ' was created', '</br>';
    }

    public function fetch(int $id)
    {
        $isExisting = parent::fetch($id);
        if ($isExisting == true)
            echo "$this->dbFile ", $id, ' was fetched', '</br>';
        else
            echo "$this->dbFile ", $id, ' was not fetched', '</br>';
    }

    public function save()
    {
        parent::save();
        echo "$this->dbFile ", ' was saved', '</br>';
    }

    public function delete(int $id)
    {
        parent::delete($id);
        echo "$this->dbFile ", $id, ' was deleted', '</br>';
    }


}

class OrdersDb extends Database
{


    private $dbFile;


    public function __construct()
    {
        parent::__construct();
        $this->dbFile = 'Order';
    }

    public function getTableName(): string
    {
        return $this->dbFile;
    }

    public function create($args)
    {
        parent::create($args);
        echo "$this->dbFile ", $args['id'], ' from ', $args['name'], ', count is ', $args['count'], ' was created', '</br>';
    }

    public function fetch(int $id)
    {
        $isExisting = parent::fetch($id);
        if ($isExisting == true)
            echo "$this->dbFile ", $id, ' was fetched', '</br>';
        else
            echo "$this->dbFile ", $id, ' was not fetched', '</br>';
    }

    public function save()
    {
        parent::save();
        echo "$this->dbFile ", ' was saved', '</br>';
    }

    public function delete(int $id)
    {
        parent::delete($id);
        echo "$this->dbFile ", $id, ' was deleted', '</br>';
    }


}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
<h1>Fake Database</h1>
<main class="container">
    <div class="card">
        <?php
        $users = new UsersDb();
        $users->create(['id' => 1, 'name' => 'Sasha', 'age' => 20, 'gender' => 'Female']);
        $users->create(['id' => 2, 'name' => 'Misha', 'age' => 23, 'gender' => 'Male']);
        $users->save();
        $user1 = $users->fetch(1);
        $user2 = $users->fetch(2);
        $user2 = $users->fetch(4);
        $users->delete(1);
        ?>
    </div>
    <div class="card">
        <?php
        $products = new ProductsDb();
        $products->create(['id' => 1, 'name' => 'Pasta', 'price' => 120]);
        $products->create(['id' => 2, 'name' => 'Gyros', 'price' => 100]);
        $products->save();
        $product1 = $products->fetch(1);
        $product2 = $products->fetch(2);
        $products->delete(1);
        ?>
    </div>
    <div class="card">
        <?php
        $orders = new OrdersDb();
        $orders->create(['id' => 1, 'name' => 'Alex', 'count' => 3]);
        $orders->create(['id' => 2, 'name' => 'Viktor', 'count' => 100]);
        $orders->save();
        $orders->delete(1);
        ?>
    </div>
</main>
</body>
</html>
