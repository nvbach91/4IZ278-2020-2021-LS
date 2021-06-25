<?php require_once __DIR__ . '/../config/global.php'; ?>
<?php require_once __DIR__ . '/DatabaseOperations.php'; ?>
<?php


abstract class Database implements DatabaseOperations {    
    public $pdo;
    public function __construct() {
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            DB_USERNAME,
            DB_PASSWORD
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
    }

    public function fetchBy($field, $value) {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';
        
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
        $result = $statement->fetch();
        return $result;
    }
    
    public function updateBy($conditions, $args) {
        $sql = 'UPDATE ' . $this->tableName . ' SET ';
        $sets = [];
        foreach($args as $key => $value) {
            $sets[] = $key . " = '" . $value . "'";
        }
        $sql .= implode(', ', $sets);
        $sql .= ' WHERE ';
        $wheres = [];
        foreach($conditions as $key => $value) {
            $wheres[] = $key . ' = ' . $value;
        }
        $sql .= implode(' && ', $wheres);

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
    }
}

?>