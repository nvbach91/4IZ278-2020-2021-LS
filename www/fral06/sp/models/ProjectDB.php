<?php

require_once __DIR__ . '/Database.php';

class ProjectDB extends Database
{

    private $table = 'projects';

    public function insert($title, $description, $author)
    {
        $statement = $this->pdo->prepare('INSERT INTO ' . $this->table . '(name, description, author) VALUES (?, ?, ?)');
        $statement->execute([
            $title,
            $description,
            $author,
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

    public function fetchProjectByEmail($email)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE author = ?');
        $statement->execute([
            $email
        ]);
        return @$statement->fetchAll();
    }

}