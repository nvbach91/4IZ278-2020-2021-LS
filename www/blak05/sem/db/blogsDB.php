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
        $sql = "INSERT INTO " . $this->tableName . " (ID_User,date, title, text, thumbnail, description, category) VALUES (1,?,?,?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($args); 
    }
    public function fetch($args)
    {
        $sql = 'SELECT b.*, u.name FROM ' . $this->tableName . ' b, Users u WHERE b.ID_Blog ='. $args . ' AND b.ID_User=u.ID_User';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetch();
    }
    public function update($args)
    {
       $sql = "UPDATE " . $this->tableName . " SET date=?, title=?, text=?, thumbnail=?, description=?, category=? WHERE ID_Blog=?";
       $statement= $this->pdo->prepare($sql);
       $statement->execute($args);
    }
    public function delete($args)
    {
        $sql = "DELETE FROM " . $this->tableName . " WHERE ID_Blog = $args[0]";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(); 
    }
}

?>