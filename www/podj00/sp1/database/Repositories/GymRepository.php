<?php require __DIR__ . '../db.php'; ?>
<?php

class GymRepository extends Database {
    protected $tableName = 'gym';
    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create($args) {
        $sql = 'INSERT INTO ' . $this->tableName . '(name, email, age) VALUES (:name, :email, :age)';
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'name' => $args['name'],
            'email' => $args['email'],
            'age' => $args['age'],
        ]);
    }
}
?>