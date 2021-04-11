<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class ProductsDB extends Database
{

    protected $tableName = 'products';
    public function fetchAll()
    {
        $offset = 0;

        if (!empty($_GET)) {
            $offset = $_GET['offset'];
        }
        $nItemsInDatabase = $this->pdo->query('SELECT COUNT(product_id) FROM ' . $this->tableName)->fetchColumn();
    

        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE 1 LIMIT ' . ITEMS_PER_PAGINATION . ' OFFSET ?;';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $offset, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function fetchNumberOfProducts()
    {
        return $this->pdo->query('SELECT COUNT(product_id) FROM ' . $this->tableName)->fetchColumn();
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