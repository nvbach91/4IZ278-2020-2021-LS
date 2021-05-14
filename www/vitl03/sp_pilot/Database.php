<?php require __DIR__ . '/database_connection.php'; ?>
<?php require __DIR__ . '/DatabaseOperations.php'; ?>
<?php

abstract class Database implements DatabaseOperations {
    protected $pdo;
    public function __construct() {
       
        try{
        $this->pdo = new PDO(
            /* DSN */ 'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            /* USR */ DB_USERNAME,
            /* PWD */ DB_PASSWORD
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // allows LIMIT
        } catch (PDOException $e) {
            exit('Connection to DB failed: ' . $e->getMessage());
        } 
    }


    public function fetchBy($field, $value) {


        // PREPARED STATEMENT: NAMED PARAMS
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);

        // ROW COUNT
        $rowCount = $statement->rowCount();

        return $statement->fetchAll();
    }

    public function SignUp()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }


    public function getPassword($password, $email)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO ' . $this->tableName  . ' (email, password)' . 'VALUES ("' . $email . '", "' . $hashedPassword . '");';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

   
    }



}

?> 