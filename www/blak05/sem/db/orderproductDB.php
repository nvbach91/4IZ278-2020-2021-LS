<?php require_once __DIR__ . '/db.php'; ?>
<?php

class OrderProductDB extends Database {
    protected $tableName = 'Product_Order';
    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create($args) {
        $sql = "INSERT INTO " . $this->tableName . " (id_product, id_order, quantity) VALUES (?,?,1)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($args);
    }
    public function fetchProduct($args)
    {
        $sql = 'SELECT op.*, p.* FROM ' . $this->tableName . ' op, Products p WHERE id_order = '. $args .' AND p.id_product=op.id_product';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function update($args)
    {
       //
    }
    public function delete($args)
    {
        // another function 
    }
}

?>