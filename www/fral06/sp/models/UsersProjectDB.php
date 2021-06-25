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

    public function fetchUsersProject($email, $projectId)
    {
        $statement = $this->pdo->prepare(
            'SELECT *  FROM ' . $this->tableName . ' WHERE `email` = ? AND `project_id` = ? LIMIT 1');
        $statement->execute([
            $email,
            $projectId
        ]);
        return @$statement->fetchAll()[0];
    }

    public function fetchProjectAssignees($projectId)
    {
        $statement = $this->pdo->prepare(
            'SELECT *  FROM ' . $this->tableName . ' WHERE  `project_id` = ?');
        $statement->execute([
            $projectId
        ]);
        return @$statement->fetchAll();
    }

    public function fetchProjectAssigneesWithName($projectId)
    {
        $statement = $this->pdo->prepare(
            'SELECT `firstName`, `lastName` FROM ' . $this->tableName .' LEFT JOIN `users` USING(`email`) WHERE  `project_id` = ?');
        $statement->execute([
            $projectId
        ]);
        return @$statement->fetchAll();
    }

    public function insert($projectId, $email)
    {
        $statement = $this->pdo->prepare('INSERT INTO ' . $this->tableName . ' (project_id, email ) VALUES (?, ?)');
        $statement->execute([
            $projectId,
            $email,
        ]);
        return @$statement->fetchAll();
    }

    public function deleteUserProject($userId, $projectId) {
        $statement = $this->pdo->prepare('DELETE FROM ' . $this->tableName . ' WHERE project_id= ? AND email = ?');
        $statement->execute([
            $projectId,
            $userId
        ]);
    }

}