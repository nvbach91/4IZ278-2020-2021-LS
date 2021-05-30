<?php require_once __DIR__ . '/db.php'; ?>
<?php

class LessonRepository extends Database
{
    protected $tableName = 'lesson';

    public function fetchAll()
    {
        //na lekci se lze přihlásit max DEN předem
        $sql = "select * from lesson INNER JOIN gym ON lesson.gym_id = gym.gym_id JOIN coach ON lesson.coach_id = coach.coach_id 
                WHERE lesson.date_from >= NOW() + INTERVAL 1 DAY";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchLessonById($lesson_id)
    {
        $sql = "select * from lesson where lesson_id = :lesson_id";
        $statement = $this->db->prepare($sql);
        $statement->execute(["lesson_id" => $lesson_id]);
        return $statement->fetchAll();
    }

    public function fetchAllByGymName($gym_name)
    {
        //na lekci se lze přihlásit max DEN předem
        $sql = "select * from lesson INNER JOIN gym ON lesson.gym_id = gym.gym_id JOIN coach ON lesson.coach_id = coach.coach_id where gym.gym_name = :gym_name
                AND lesson.date_from >= NOW() + INTERVAL 1 DAY";
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'gym_name' => $gym_name,
        ]);
        return $statement->fetchAll();
    }

    public function reserveLesson($user, $lessonId)
    {
        //někde check jesti už na té lekci není, možná FE validace ?!
        //optimistic lock?!
        $lesson = $this->fetchLessonById($lessonId);
        var_dump($lesson);
        $totalCapacity = $lesson[0]["total_capacity"];
        $filledCapacity = $lesson[0]["filled_capacity"];
        if ($filledCapacity == $totalCapacity) {
            //optimistic lock .. je plno .)
            return false;
        }

        //TODO asi to bude muset zapisovat i do té tabulky USERS_LESSONS!!!!
        $sql1 = "UPDATE `$this->tableName` SET `filled_capacity` = :filled_capacity WHERE lesson_id = :lesson_id";
        $statement1 = $this->db->prepare($sql1);
        $statement1->execute([
            'filled_capacity' => $filledCapacity + 1,
            'lesson_id' => $lessonId
        ]);
        $statement1->fetchAll();

        //TODO musí se to zapsat do M_N tabulky
        $sql2 = 'INSERT INTO users_lessons (user_id, lesson_id) VALUES (:user_id, :lesson_id)';
        $statement2 = $this->db->prepare($sql2);
        $statement2->execute([
            'user_id' => $user[0]["user_id"],
            'lesson_id' => $lessonId
        ]);
        $statement2->fetchAll();

        return true;
    }

    public function removeLesson($user, $lessonId)
    {
        $lesson = $this->fetchLessonById($lessonId);
        $filledCapacity = $lesson[0]["filled_capacity"];

        $sql1 = "UPDATE `$this->tableName` SET `filled_capacity` = :filled_capacity WHERE lesson_id = :lesson_id";
        $statement1 = $this->db->prepare($sql1);
        $statement1->execute([
            'filled_capacity' => $filledCapacity - 1,
            'lesson_id' => $lessonId
        ]);
        $statement1->fetchAll();

        $sql2 = 'DELETE FROM users_lessons WHERE lesson_id = :lesson_id AND user_id = :user_id';
        $statement2 = $this->db->prepare($sql2);
        $statement2->execute([
            'lesson_id' => $lessonId,
            'user_id' => $user[0]["user_id"]
        ]);

        $statement2->fetchAll();

    }

    public function getLessonsForUser($username, $facebook_id)
    {
        $statement = null;
        if (isset($facebook_id)) {
            $sql = "SELECT * from lesson JOIN users_lessons ON lesson.lesson_id=users_lessons.lesson_id JOIN user ON users_lessons.user_id = user.user_id 
                    JOIN coach ON lesson.coach_id = coach.coach_id JOIN gym ON lesson.gym_id = gym.gym_id 
                    where user.facebook_id = :facebook_id AND lesson.date_from >= NOW()";
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'facebook_id' => $facebook_id
            ]);
        } else {
            $sql = "SELECT * from lesson JOIN users_lessons ON lesson.lesson_id=users_lessons.lesson_id JOIN user ON users_lessons.user_id = user.user_id 
                    JOIN coach ON lesson.coach_id = coach.coach_id JOIN gym ON lesson.gym_id = gym.gym_id 
                    where user.username = :username AND lesson.date_from >= NOW()";
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'username' => $username
            ]);
        }
        return $statement->fetchAll();
    }
}

?>