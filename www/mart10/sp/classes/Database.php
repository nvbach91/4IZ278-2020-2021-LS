<?php
require_once "config/global.php";

class Database
{
    private $connection = null;

    public function __construct($dbhost=DB_HOST, $dbname=DB_DATABASE, $username=DB_USERNAME, $password=DB_PASSWORD){

        try{

            $this->connection = new PDO("mysql:host={$dbhost};dbname={$dbname};charset=utf8", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }

    }

    /**
     * @throws Exception
     */
    public function insert($statement = "" , $parameters = [] ){
        try{

            $this->execute( $statement , $parameters );
            return $this->connection->lastInsertId();

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function select($statement = "" , $parameters = [] ){
        try{

            $stmt = $this->execute( $statement , $parameters );
            return $stmt->fetchAll();

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function update($statement = "" , $parameters = [] ){
        try{

            $this->execute( $statement , $parameters );

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function remove($statement = "" , $parameters = [] ){
        try{

            $this->execute( $statement , $parameters );

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    private function execute($statement = "" , $parameters = [] ){
        try{

            $stmt = $this->connection->prepare($statement);
            $stmt->execute($parameters);
            return $stmt;

        }catch(Exception $e){
            throw new Exception($stmt->errorCode().';'.$e->getMessage());
        }
    }
}