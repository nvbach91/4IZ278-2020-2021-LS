<?php require_once __DIR__ . '/db.php'; ?>
<?php

class CoachRepository extends Database {
    protected $tableName = 'gym';
    //TODO tohle reálně vrátí všechny COACHE - bude to na sobě mít asi JEN?! lessonId nebo celou lesson?
    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
}
?>