<?php require_once __DIR__ . '/Database.php'; ?>

<?php

class WorkplacesDB extends Database
{
    protected $tableName = 'workplace';
    
      
    public function create($item) {
        $sql = 'INSERT INTO ' . $this->tableName . '(name, price, active) VALUES (:name, :price, :active)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $item['name'], 
            'price' => $item['price'], 
            'active' => $item['active'],
        ]);
    }

}
?>