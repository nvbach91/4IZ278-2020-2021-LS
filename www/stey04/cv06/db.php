<?php require __DIR__ . '/db_config.php'; ?>

<?php
interface DatabaseOperations
{
    //public function create($args);
    public function fetch();
    //public function save();
    //public function delete();
}

abstract class Database implements DatabaseOperations
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            DB_USER,
            DB_PASSWORD,
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function fetch()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getInfo()
    {
        return $this;
    }
}


class ProductsDB extends Database
{
    protected $tableName = 'products';

    public function create($args)
    {
        $sql = 'INSERT INTO ' . $this->tableName . '(name, price, img) VALUES (:name, :price, :img)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $args['name'],
            'price' => $args['price'],
            'img' => $args['img'],
        ]);
    }
    /*
    public function fetch()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
     */
}

class CategoriesDB extends Database
{
    protected $tableName = 'categories';
}

class SlidesDB extends Database
{
    protected $tableName = 'slides';

    public function create($args)
    {
        $sql = 'INSERT INTO ' . $this->tableName . '(img, title) VALUES (:img, :title)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'img' => $args['img'],
            'title' => $args['title'],
        ]);
    }
}
