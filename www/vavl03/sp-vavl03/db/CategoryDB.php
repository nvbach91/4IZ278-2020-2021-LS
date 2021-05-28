<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class CategoryDB extends Database
{
    protected $tableName = 'category';
    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create($args)
    {
        $sql = 'INSERT INTO ' . $this->tableName . '(number, name) VALUES (:number, :name)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'number' => $args['number'],
            'name' => $args['name'],

        ]);
    }
}

?>