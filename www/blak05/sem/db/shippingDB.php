<?php require_once __DIR__ . '/db.php'; ?>
<?php

class ShippingDB extends Database {
    protected $tableName = 'Shipping';
    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create($args) {
        //
    }
    public function fetch($args)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE id_shipping ='. $args;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetch();
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