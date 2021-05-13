<?php

class Db{
    private $servername;
    private $username;
    private $password;
    private $db;
    private $conn;

    /**
     * Db constructor.
     * @param string $servername
     * @param string $username
     * @param string $password
     * @param string $db
     */
    public function __construct(string $servername = "localhost", string $username = "krij09", string $password = "mei4aeceir4eingev4", string $db= "krij09")
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;
    }

    public function createConn()
    {
        try{
            $this->conn = new PDO("mysql:dbname=".$this->db.";host=".$this->servername.";charset=utf8",$this->username,$this->password);
        } catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function getConn()
    {
        return $this->conn;
    }

    public function closeConn()
    {
        $this->conn = null;
    }



}