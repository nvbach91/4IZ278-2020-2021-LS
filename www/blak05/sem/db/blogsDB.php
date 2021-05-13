<?php require_once __DIR__ . '/db.php'; ?>
<?php

class BlogsDB extends Database
{
    protected $tableName = 'Blogs';
    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' ORDER BY date DESC';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create($args)
    {
        // another function 
    }
    public function fetch($args)
    {
        $sql = 'SELECT b.*, u.name FROM ' . $this->tableName . ' b, Users u WHERE b.ID_Blog ='. $args . ' AND b.ID_User=u.ID_User';
        // SELECT w.*, u.Forename, u.Surname FROM Wall w, Users u WHERE w.UserID=u.UserID
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetch();
    }
    public function update($args)
    {
        // another function  
    }
    public function delete($args)
    {
        // another function 
    }
}

?>