<?php require __DIR__ . '/Config.php'; ?>
<?php require __DIR__ . '/CRUD.php'; ?>

<?php
abstract class DatabaseConnect implements CRUD {
    protected $pdo;
    public function __construct() {
       
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            DB_USERNAME,
            DB_PASSWORD
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    public function fetchBy($field, $value) {
       
    }
    public function updateBy($conditions, $args) {
      
    }
    public function deleteBy($field, $value) {
      
    }
    public function create($args) {
      
    }
    public function fetchAll() {
      
    }
}

?>

