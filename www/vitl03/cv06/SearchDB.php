<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class SearchDB extends Database
{
   
    public function fetchAll()
    {
        $id = @$_GET['id'];

        $sql = "SELECT * FROM products WHERE product_id=:id;";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);
        return $statement->fetchAll();
    }
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
    public function fetch($args)
    {
        // fetch specified product
    }
    public function update($args)
    {
        // update specified product  
    }
    public function delete($args)
    {
        // delete specified product
    }
}

?> 