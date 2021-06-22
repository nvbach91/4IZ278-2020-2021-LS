<?php

require_once __DIR__ . '/Database.php';

class TaskDB extends Database {
    private $table = 'tasks';

    public function insert($title, $description, $storyPoints, $projectId)
    {
        $statement = $this->pdo->prepare('INSERT INTO ' . $this->table . '(title, description, storyPoints, project_id ) VALUES (?, ?, ?, ?)');
        $statement->execute([
            $title,
            $description,
            $storyPoints,
            $projectId
        ]);
    }

    public function fetchByProject($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE project_id =? ');
        $statement->execute([
            $id
        ]);
        return @$statement->fetchAll();
    }

    public function fetchByUser($email)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE email =? LIMIT 1');
        $statement->execute([
            $email
        ]);
        return @$statement->fetchAll()[0];
    }
}