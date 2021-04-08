<?php require __DIR__ . '/../config/global.php'; ?>

<?php


interface DatabaseOperations
{
    public function fetchAll();
    public function create($item);
    public function fetchBy($id, $value);
    // public function updateBy($id, $item);
    public function deleteBy($id, $value);
}

abstract class Database implements DatabaseOperations
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            DB_USERNAME,
            DB_PASSWORD
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }


    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchBy($id, $value)
    {
        $sql = 'SELECT * FROM ' . $this->tableName .  ' WHERE ' . $id . ' = :value';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
        return $statement->fetchAll();
    }

    public function deleteBy($id, $value) {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $id . ' = :value';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
    }

 
}

?>