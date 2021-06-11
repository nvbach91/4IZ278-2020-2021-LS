<?php require_once __DIR__ . '/db.php'; ?>
<?php

class UsersDB extends Database {
    protected $tableName = 'Users';
    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName . ' LIMIT 3';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create($args) {
        $sql = "INSERT INTO " . $this->tableName . " (name, email, address, city, psc, password, newsletter, priv) VALUES (?,?,?,?,?,?,?,0)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($args);
    }
    public function fetchCount($args)
    {
        $statement = $this->pdo->query("SELECT COUNT(ID_User) FROM " . $this->tableName . " WHERE email='$args'")->fetchColumn();
        return $statement;
    }
    public function fetch($args)
    {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE email='$args'";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetch();
    }
    public function update($args)
    {
        $sql = "UPDATE " . $this->tableName . " SET name=?, address=?, city=?, psc=?, newsletter=? WHERE email=?";
        $statement= $this->pdo->prepare($sql);
        $statement->execute($args);
    }
    public function delete($args)
    {
        // another function 
    }
}

?>