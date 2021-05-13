<?php require __DIR__ . '/../../config/config.php'; ?>
<?php

abstract class Database  {
    protected $db;
    public function __construct() {
        try {
        $this->db = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
         DB_USERNAME,
        DB_PASSWORD
        );
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $exception) {
            exit('Connection failed cuz of: ' . $exception->getMessage());
        }
    }

    public function deleteBy($field, $value) {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';
        $statement = $this->db->prepare($sql);
        $statement->execute(['value' => $value]);
    }
}

?>