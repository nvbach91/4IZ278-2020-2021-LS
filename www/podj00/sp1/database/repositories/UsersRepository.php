<?php require_once __DIR__ . '/db.php'; ?>
<?php

class UsersRepository extends Database {
    protected $tableName = 'user';
    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function createUser($args) {
        $sql = 'INSERT INTO ' . $this->tableName . '(name, email, password) VALUES (:name, :email, :password)';
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'username' => $args['username'],
            'email' => $args['email'],
            'password' => $args['password'],
        ]);
        $statement->fetchAll();
    }

    public function getUser($userId) {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE user_id = :id';
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'id' => $userId
        ]);
        return $statement->fetchAll();
    }
}
?>