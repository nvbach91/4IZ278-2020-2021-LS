<?php require_once __DIR__ . '/db.php'; ?>
<?php

class CategoriesDB extends Database {
    protected $tableName = 'categories';

    public function fetchAll() {
        $sql = "SELECT * FROM $this->tableName";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();        
    }

    public function fetchId($id) {
        $sql = "SELECT id FROM $this->tableName WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        return $statement->fetchAll();
    }
}
?>