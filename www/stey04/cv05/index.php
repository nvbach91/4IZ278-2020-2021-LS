<?php
interface DatabaseOperations
{
    public function create($args);
    public function fetch();
    public function save();
    public function delete();
}

abstract class Database implements DatabaseOperations
{
    protected $path = './';
    protected $ext = '.db';
    protected $sep = ';';

    public function __construct()
    {
        echo '-----', static::class, ' was instantiated-----', PHP_EOL;
    }

    public function __toString()
    {
        return "database config: path to file: $this->path, file extenstion: $this->ext, record's delimiter: $this->sep";
    }

    public function getInfo()
    {
        return $this;
    }
}

class UsersDB extends Database
{
    public function create($args)
    {
        echo 'User ', $args['name'], ' age: ', $args['age'], ' was created', PHP_EOL;
    }
    public function fetch()
    {
        echo "User info...", PHP_EOL;
    }
    public function save()
    {
        echo "Saving a user...", PHP_EOL;
    }
    public function delete()
    {
        echo "Deleting a user...", PHP_EOL;
    }
}

class ProductsDB extends Database
{
    public function create($args)
    {
        echo 'Product ', $args['name'], ' was created', PHP_EOL;
    }
    public function fetch()
    {
        echo "Product info...", PHP_EOL;
    }
    public function save()
    {
        echo "Saving a product...", PHP_EOL;
    }
    public function delete()
    {
        echo "Deleting a product...", PHP_EOL;
    }
}
class OrdersDB extends Database
{
    public function create($args)
    {
        echo 'Order ', $args['name'], ' was created', PHP_EOL;
    }
    public function fetch()
    {
        echo "Order info...", PHP_EOL;
    }
    public function save()
    {
        echo "Saving an order...", PHP_EOL;
    }
    public function delete()
    {
        echo "Deleting an order", PHP_EOL;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cv05</title>
</head>

<body>
    <pre>
    <?php
    $userdb = new UsersDB();
    echo $userdb->create(['name' => 'John Doe', 'age' => 44]);
    echo $userdb->fetch();
    echo $userdb->save();
    echo $userdb->delete();
    echo $userdb->getInfo();
    echo PHP_EOL;
    echo PHP_EOL;

    $productdb = new ProductsDB();
    echo $productdb->create(['name' => 'Mushrooms', 'description' => 'Poisonous']);
    echo PHP_EOL;

    $orderdb = new OrdersDB();
    echo $orderdb->create(['name' => 'Poisonous mushroom']);
    echo $orderdb->fetch('poison');
    echo $orderdb->save();
    ?>
    </pre>
</body>

</html>