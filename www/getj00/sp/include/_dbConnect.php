<?php
// Password needs to be censored before submitting to Git

class DBConnection{
    protected $pdo;
    
    // specific queries are to be added by inheritance

    public function __construct(){
        $this->pdo=new PDO('mysql:host=localhost;dbname=getj00;charset=utf8mb4', 'getj00', '[REDACTED]');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function __toString(){
        return $this->pdo->__toString();
    }

    public function executeQuery($query, $params){
        $query->execute($params);
    }
    
    public function fetchResults($query){
        return $query->fetchAll();
    }
    
}

$itemsPerPage=[25, 50, 100, 250, 500, 1000];

