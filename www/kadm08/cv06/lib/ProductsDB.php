<?php require_once __DIR__ . '/Database.php'; ?>

<?php

class ProductsDB extends Database
{
    protected $tableName = 'products';
    
      
    public function create($item) {
        $sql = 'INSERT INTO ' . $this->tableName . '(name, price, img) VALUES (:name, :price, :img)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $item['name'], 
            'price' => $item['price'], 
            'img' => $item['img'],
        ]);
    }

}
?>