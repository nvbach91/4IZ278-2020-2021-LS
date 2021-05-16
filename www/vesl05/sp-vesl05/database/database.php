<?php require __DIR__ . '/../config/config.php'; ?>
<?php require __DIR__ . '/DatabaseOperations.php'; ?>

<?php
abstract class Database implements DatabaseOperations {

    protected $databaseObject;

    public function __construct() {
        try{
        $this->databaseObject = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            DB_USERNAME,
            DB_PASSWORD
            );
        $this->databaseObject->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            exit('Database connection failed: ' . $getMessage());
        }
    }

    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->databaseObject->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchBy($field, $value) {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';
        $statement = $this->databaseObject->prepare($sql);
        $statement->execute(['value' => $value]);

        return $statement->fetchAll();
    }

    public function deleteBy($field, $value) {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';
        $statement = $this->databaseObject->prepare($sql);
        $statement->execute(['value' => $value]);
    }
}
?>