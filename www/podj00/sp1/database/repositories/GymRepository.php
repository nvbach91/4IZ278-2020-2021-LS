<?php require_once __DIR__ . '/db.php'; ?>
<?php

class GymRepository extends Database
{
    protected $tableName = 'gym';

    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getGymWithLectures($gym)
    {
        //TODO tady bude nějaký joiník
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE name = :name';
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'name' => $gym
        ]);
        return $statement->fetchAll();
    }

}

?>