<?php require __DIR__ . '/../config/config.php'; ?>
<?php require __DIR__ . '/DatabaseOperations.php'; ?>
<?php

abstract class Database implements DatabaseOperations {
    protected $db;
    public function __construct() {
        $this->db = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
         DB_USERNAME,
        DB_PASSWORD
        );
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    public function fetchBy($field, $value) {
        // PREPARED STATEMENT: POSITIONAL PARAMS
        // $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $field . ' = ?';
        // $statement = $this->pdo->prepare($sql);
        // $statement->bindValue(1, $value);
        // $statement->execute();
        // return $statement->fetchAll();

        // $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $field . ' = ?';
        // $statement = $this->pdo->prepare($sql);
        // $statement->execute([$value]);
        // return $statement->fetchAll();

        // PREPARED STATEMENT: NAMED PARAMS
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';
        $statement = $this->db->prepare($sql);
        $statement->execute(['value' => $value]);

        // ROW COUNT
        $rowCount = $statement->rowCount();

        return $statement->fetchAll();
    }
    public function updateBy($conditions, $args) {
        $sql = 'UPDATE ' . $this->tableName . ' SET ';
        $sets = [];
        foreach($args as $key => $value) {
            $sets[] = $key . ' = :' . $key;
        }
        $sql .= implode(', ', $sets);
        $sql .= ' WHERE ';
        $wheres = [];
        foreach($conditions as $key => $value) {
            $wheres[] = $key . ' = :' . $key;
        }
        $sql .= implode(' && ', $wheres);
        echo $sql;
        $statement = $this->db->prepare($sql);
        foreach($args as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        foreach($conditions as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        $statement->execute();
    }
    public function deleteBy($field, $value) {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';
        $statement = $this->db->prepare($sql);
        $statement->execute(['value' => $value]);
    }
}

?>

<?php
// nenahravat username a password, ani dbname na git!
/*$db = new PDO(
    'mysql:host=localhost;dbname=test;charset=utf8mb4',
    'root',
    'root'
);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); */
?>