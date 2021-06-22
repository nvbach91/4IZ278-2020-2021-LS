<?php

require_once __DIR__ . '/Database.php';

class ProjectDB extends Database
{

    private $table = 'projects';

    public function insert($email, $hashedPassword, $role, $firstName, $lastName)
    {
        $statement = $this->pdo->prepare('INSERT INTO ' . $this->table . '(email, hashedPassword, role, firstName, lastName ) VALUES (?, ?, ?, ?,?)');
        $statement->execute([
            $email,
            $hashedPassword,
            $role,
            $firstName,
            $lastName
        ]);
    }

    public function fetchProjectById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE project_id =? LIMIT 1');
        $statement->execute([
            $id
        ]);
        return @$statement->fetchAll()[0];
    }

}