<?php

require_once __DIR__ . '/Database.php';

class UsersTask extends Database
{
    private $table = 'asigned_tasks';

    public function fetchAllUsersTasks($email)
    {
        $statement = $this->pdo->prepare(
            'SELECT tasks.description, projects.name, tasks.task_id  FROM ' . $this->table . ' LEFT JOIN `tasks` USING(`project_id`) LEFT JOIN `projects` USING(`project_id`) WHERE `email` = ?');
        $statement->execute([
            $email
        ]);
        return @$statement->fetchAll();
    }

}