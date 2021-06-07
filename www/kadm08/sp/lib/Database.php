<?php

abstract class Database
{
    protected $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:host=localhost;dbname=coworking;charset=utf8mb4',
                'root',
                ''
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit('Connection to database failed: ' . $e->getMessage());
        }
    }

}
