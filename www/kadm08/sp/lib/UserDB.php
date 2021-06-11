<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class UserDB extends Database
{
    public function fetchAllUsers()
    {
        $sql = "SELECT * FROM user";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function fetchAllClients()
    {
        $sql = "SELECT * FROM client";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function fetchUser($user_id)
    {
        $sql = "SELECT u.user_id, u.email, u.password, u.type, c.name, c.surname, c.phone,  c.client_id
            FROM user u 
            LEFT JOIN client c on u.user_id = c.user_id
            WHERE u.user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetch();
    }

    public function fetchUserByEmail($email)
    {
        $sql = "SELECT u.user_id, u.email, u.password, u.type, c.name, c.surname, c.phone,  c.client_id
            FROM user u 
            LEFT JOIN client c on u.user_id = c.user_id
            WHERE u.email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function createUser($email, $password)
    {
        $sql = "INSERT INTO user (email, password) VALUES ( :email, :password)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'password' => $password
        ]);
    }

    public function createClient($user_id, $name, $surname, $phone)
    {
        $sql = "INSERT INTO client (name, surname, phone, registration_date, user_id) VALUES ( :name, :surname, :phone, NOW(), :user_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id,
        'name' => $name,
        'surname' => $surname,
        'phone' => $phone]);
    }

    public function updateClient($user_id, $name, $surname, $phone)
    {
        $sql = "UPDATE client SET
                    name = :name,
                    surname = :surname,
                    phone = :phone
                WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "user_id" => $user_id,
            "name" => $name,
            "surname" => $surname,
            "phone" => $phone
        ]);
    }

    public function updateEmail($user_id, $email)
    {
        $sql = "UPDATE user SET email = :email
                WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "user_id" => $user_id,
            "email" => $email
        ]);
    }

    public function updatePassword($user_id, $password)
    {
        $sql = "UPDATE user SET password = :password
                WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "user_id" => $user_id,
            "password" => $password
        ]);
    }
}

?>