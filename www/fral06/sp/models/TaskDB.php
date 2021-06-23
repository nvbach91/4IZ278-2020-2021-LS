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
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE project_id = ?');
        $statement->execute([
            $id
        ]);
        return @$statement->fetchAll();
    }

    public function fetchByUser($email)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE email = ? LIMIT 1');
        $statement->execute([
            $email
        ]);
        return @$statement->fetchAll()[0];
    }

    public function fetchById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE task_id = ? LIMIT 1');
        $statement->execute([
            $id
        ]);
        return @$statement->fetchAll()[0];
    }

    public function updateTask($title, $description, $storyPoints, $taskId)
    {
        $statement = $this->pdo->prepare('UPDATE ' . $this->table . ' SET title = ?, description = ?, storyPoints = ?  WHERE task_id = ?');
        $statement->execute([
            $title,
            $description,
            $storyPoints,
            $taskId
        ]);
        return @$statement->fetchAll()[0];
    }

    public function deleteTask($id) {
        $statement = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE task_id= ?');
        $statement->execute([
            $id
        ]);
    }
}