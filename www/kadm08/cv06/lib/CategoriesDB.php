<?php require_once __DIR__ . '/Database.php'; ?>

<?php

class CategoriesDB extends Database
{
    protected $tableName = 'categories';


    public function create($item)
    {
        $sql = 'INSERT INTO ' . $this->tableName . '(number, name) VALUES (:number, :name)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'number' => $item['number'],
            'name' => $item['name'],
        ]);
    }    
}

?>