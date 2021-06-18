<?php
include_once __DIR__ . '/../interfaces/DatabaseOperations.php';
include_once __DIR__ . '/../../config/config.php';

abstract class Database
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

    public function fetchAll(){
        $sql = 'SELECT * FROM ' . $this->tableName .' WHERE' . '1';
        $request = $this->pdo->prepare($sql);
        $request->execute();

        return $request->fetchAll();
    }

    public function fetchBy($params = array()){
        $where = '1';
        foreach ($params as $key => $param) {
            $where = $where . ' AND ' . $key . ' = ' . "'".$param ."'";
        }
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $where. ';';
        $request = $this->pdo->prepare($sql);
        $request->execute();

        return $request->fetchAll();
    }

    public function createRecord($params = array()) {
        $columns = "";
        $values = "";
        $numItems = count($params);
        $i = 0;
        foreach($params as $key=>$param) {
            if(++$i === $numItems) {
                $columns = $columns . $key;
                $values = $values. ':'.$key;
            }
            else {
                $columns = $columns . $key . ',';
                $values = $values. ':'.$key . ',';
            }

        }
        $sql = 'INSERT INTO '.$this->tableName.'('.$columns.')'.' VALUES ('.$values.')';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
    }

    public function updateRecord($params= array()){
        
        $columns="";
        $numItems = count($params);
        $i = 0;
        foreach($params as $key=>$param) {
            if(++$i === $numItems) {
                $columns = $columns . $key . ' = ' . ':'.$key.' ';
            }
            else {
                $columns = $columns . $key . ' = ' . ':'.$key.', ';
            }             
        }
        $sql = "UPDATE ".$this->tableName. " SET ".$columns . "WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
    }

    public function deleteRecord($ids = array()) {

        $stmt = $this->pdo->prepare("DELETE FROM ". $this->tableName . " WHERE id = :id;");
        $stmt->execute($ids);
    }

}
?>