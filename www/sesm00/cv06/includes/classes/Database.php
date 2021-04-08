<?php
include_once __DIR__ . '/../interfaces/DatabaseOperations.php';

abstract class Database implements DatabaseOperations
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
            DB_USER,
            DB_PASS
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    protected function readDatabase($params = array()) {
        $where = '1';
        foreach ($params as $key => $param) {
            $where = ' AND ' . $key . ' = :' . $key;
        }
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $where;
        $request = $this->pdo->prepare($sql);
        $request->execute($params);

        return $request->fetchAll();
    }

}