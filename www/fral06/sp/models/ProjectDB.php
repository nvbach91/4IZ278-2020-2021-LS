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
        return @$this->pdo->lastInsertId();
    }

    public function fetchProjectById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE project_id =? LIMIT 1');
        $statement->execute([
            $id
        ]);
        return @$statement->fetchAll()[0];
    }

    public function fetchAll()
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->table );
        $statement->execute();
        return @$statement->fetchAll();
    }

    public function fetchProjectByEmail($email)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE author = ?');
        $statement->execute([
            $email
        ]);
        return @$statement->fetchAll();
    }

    public function updateProject($title, $description, $projectId)
    {
        $statement = $this->pdo->prepare('UPDATE ' . $this->table . ' SET name = ?, description = ?  WHERE project_id = ?');
        $statement->execute([
            $title,
            $description,
            $projectId
        ]);
        return @$statement->fetchAll()[0];
    }

}