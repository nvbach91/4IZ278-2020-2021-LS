<?php require_once __DIR__ . '/db.php'; ?>
<?php

class UsersDB extends Database {
    protected $tableName = 'users';

    function createUser($name, $email, $hashedPassword) {
        $sql = "INSERT INTO $this->tableName(name, email, password) VALUES (:name, :email, :password)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ]);
    }

    function findUser($email) {
        $sql = "SELECT * FROM $this->tableName WHERE email = :email";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'email' => $email
        ]);
        return @$statement->fetchAll()[0];
    }

    function findUserId($email) {
        $sql = "SELECT id FROM $this->tableName WHERE email = :email";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'email' => $email
        ]);
        return $statement->fetchColumn();
    }
}
?>