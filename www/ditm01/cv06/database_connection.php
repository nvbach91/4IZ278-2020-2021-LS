<?php 
    const DB_HOST = 'localhost';
    const DB_DATABASE = 'ditm01';
    const DB_USER = 'ditm01';
    const DB_PASSWORD = 'aePhahzaiceP9ceiT4';

    const CURRENCY = 'CZK';

    abstract class Database {
        protected $pdo;
        public function __construct() {
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            DB_USER,
            DB_PASSWORD,
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
    }
?>