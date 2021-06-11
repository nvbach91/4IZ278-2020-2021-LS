<?php require_once __DIR__ . '/db.php'; ?>
<?php

class OrderDB extends Database {
    protected $tableName = 'Orders';
    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create($args) {
        $sql = "INSERT INTO " . $this->tableName . " (ID_User, total_price, date, id_shipping, id_payment) VALUES (?,?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($args);
    }
    public function fetchLast()
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE id_order = (SELECT MAX(id_order) FROM Orders) ';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetch();
    }
    public function fetchName($args)
    {
        $sql = 'SELECT o.*, s.name AS doprava, p.name AS platba FROM ' . $this->tableName . ' o, Shipping s, Payment p WHERE o.id_user = '. $args .' AND s.id_shipping = o.id_shipping AND p.id_payment = o.id_payment ORDER BY o.date DESC;';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchOffset($args)
    {
        $sql = 'SELECT o.*, s.name AS doprava, p.name AS platba FROM ' . $this->tableName . ' o, Shipping s, Payment p WHERE o.id_user='.$args[0].' AND s.id_shipping = o.id_shipping AND p.id_payment = o.id_payment ORDER BY o.date DESC LIMIT '.$args[1].' OFFSET ?';
        $statement = $this->pdo->prepare($sql);
        //$statement->execute();
        $statement->bindValue(1, $args[2]);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchCount($args)
    {
        $statement = $this->pdo->query("SELECT COUNT(id_order) FROM " . $this->tableName . " WHERE id_user='$args'")->fetchColumn();
        return $statement;
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