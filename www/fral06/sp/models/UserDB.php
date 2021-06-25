<?php

require_once __DIR__ . '/Database.php';

class UserDB extends Database
{
    private $table = 'users';

    public function insert($email, $hashedPassword, $role, $firstName, $lastName)
    {
        $statement = $this->pdo->prepare('INSERT INTO ' . $this->table . '(email, passwordHash, role, firstName, lastName ) VALUES (?, ?, ?, ?,?)');
        $statement->execute([
            $email,
            $hashedPassword,
            $role,
            $firstName,
            $lastName
        ]);
    }

    public function fetchUserByEmail($email)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE email =? LIMIT 1');
        $statement->execute([
            $email
        ]);
        return @$statement->fetchAll()[0];
    }

    public function fetchAll()
    {
        $statement = $this->pdo->prepare('SELECT email, firstName, lastName FROM ' . $this->table);
        $statement->execute();
        return @$statement->fetchAll();
    }

}