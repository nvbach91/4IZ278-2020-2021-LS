<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class UsersDB extends Database {
    protected $tableName = 'users';
    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    
    public function create($args) {
        $sql = 'INSERT INTO ' . $this->tableName . '(user_name, user_email, user_password) VALUES (:name, :email, :password)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $args['user_name'], 
            'email' => $args['user_email'], 
            'password' => $args['user_hashedPassword'], 
        ]);
    }
}

?>