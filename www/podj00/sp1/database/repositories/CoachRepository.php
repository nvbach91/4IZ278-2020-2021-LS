<?php require_once __DIR__ . '/db.php'; ?>
<?php

class CoachRepository extends Database
{
    protected $tableName = 'coach';

    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
}

?>