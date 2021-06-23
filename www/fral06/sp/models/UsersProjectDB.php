<?php

require_once __DIR__ . '/Database.php';

class UsersProjectDB extends Database
{
    private $tableName = 'users_projects';

    public function fetchAllUsersProjects($email)
    {
        $statement = $this->pdo->prepare(
            'SELECT  projects.name, projects.description, projects.project_id  FROM ' . $this->tableName . ' LEFT JOIN `projects` USING(`project_id`) WHERE `email` = ?');
        $statement->execute([
            $email
        ]);
        return @$statement->fetchAll();
    }
    public function fetchUsersProject($email, $proejctId)
    {
        $statement = $this->pdo->prepare(
            'SELECT *  FROM ' . $this->tableName . ' WHERE `email` = ? AND `project_id` = ? LIMIT 1');
        $statement->execute([
            $email,
            $proejctId
        ]);
        return @$statement->fetchAll()[0];
    }
}