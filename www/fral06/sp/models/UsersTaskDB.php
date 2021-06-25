<?php

require_once __DIR__ . '/Database.php';

class UsersTaskDB extends Database
{
    private $table = 'asigned_tasks';

    public function fetchAllUsersTasks($email)
    {
        $statement = $this->pdo->prepare(
            'SELECT tasks.title, projects.name, tasks.task_id  FROM ' . $this->table . ' LEFT JOIN `tasks` USING(`project_id`) LEFT JOIN `projects` USING(`project_id`) WHERE `email` = ?');
        $statement->execute([
            $email
        ]);
        return @$statement->fetchAll();
    }

    public function fetchAssignee($id)
    {
        $statement = $this->pdo->prepare(
            'SELECT users.firstName, users.lastName  FROM ' . $this->table . ' LEFT JOIN `users` USING(`email`) WHERE `task_id` = ?');
        $statement->execute([
            $id
        ]);
        return @$statement->fetchAll()[0];
    }

    public function deleteUsersTask($id) {
        $statement = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE task_id= ?');
        $statement->execute([
            $id
        ]);
    }

    public function insert($ticketId, $projectId, $email) {
        $statement = $this->pdo->prepare('INSERT INTO ' . $this->table . '(task_id, project_id, email ) VALUES (?, ?, ?)');
        $statement->execute([
            $ticketId,
            $projectId,
            $email,
        ]);
    }

}