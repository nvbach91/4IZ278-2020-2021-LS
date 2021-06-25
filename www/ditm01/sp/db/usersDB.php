<?php require_once __DIR__ . '/db.php'; ?>
<?php

class UsersDB extends Database {
    protected $tableName = 'users';

    public function createUser($name, $email, $hashedPassword) {
        $sql = "INSERT INTO $this->tableName(name, email, password) VALUES (:name, :email, :password)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ]);
    }

    public function findUser($email) {
        $sql = "SELECT * FROM $this->tableName WHERE email = :email";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'email' => $email
        ]);
        return @$statement->fetchAll()[0];
    }

    public function findUserId($email) {
        $sql = "SELECT id FROM $this->tableName WHERE email = :email";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'email' => $email
        ]);
        return $statement->fetchColumn();
    }

    public function updateUser($userInfo) {
        $sql = "UPDATE $this->tableName SET phone = :phone, address = :address, zip = :zip, city = :city, country = :country WHERE id = :user_id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'phone' => $userInfo['phone'],
            'address' => $userInfo['address'],
            'zip' => $userInfo['zip'],
            'city' => $userInfo['city'],
            'country' => $userInfo['country'],
            'user_id' => $userInfo['user_id']
        ]);
    }
}
?>