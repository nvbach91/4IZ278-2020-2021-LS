<?php require_once __DIR__ . '/db.php'; ?>
<?php

class LessonRepository extends Database {
    protected $tableName = 'lesson';
    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function reserveLesson($house_numero, $userId, $lessonId) {
        //někde check jesti už na té lekci není, možná FE validace ?!
        $sql = "UPDATE `$this->tableName` SET `filled_capacity` = :house_numbero, `user_id` = :user_id WHERE lesson_id = :id";
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'house_numero' => $house_numero,
            'user_id' => $userId,
            'id' => $lessonId
        ]);
    }
}
?>