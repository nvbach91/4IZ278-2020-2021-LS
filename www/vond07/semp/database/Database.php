<?php require_once __DIR__ . '/../config/config.php'; ?>
<?php
	abstract class Database {
		protected $db;
		public function __construct() {
			try{
				$this->db = new PDO(
				'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
				DB_USERNAME,
				DB_PASSWORD
				);
			} catch (PDOException $e) {
				exit('Connection to DB failed: ' . $e->getMessage());
			} 
		}
		public function list() {
			$sql = 'SELECT * FROM ' . $this->tableName;
			$statement = $this->db->prepare($sql);
			$statement->execute();
			return $statement->fetchAll();
		}
		public function find($field, $value) {
			$sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';
			$statement = $this->db->prepare($sql);
			$statement->execute(['value' => $value]);
			return $statement->fetchAll();  
		}
		public function findById($id) {
			return $this->find('ID', $id);
		}
		public function countOf(){
			$sql = 'SELECT COUNT(ID) FROM ' . $this->tableName;
			$statement = $this->db->prepare($sql);
			return $statement->fetch();
		}
	}
?> 