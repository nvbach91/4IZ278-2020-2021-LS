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

      protected function readData($params = array(), $skip = null) {
        $where = '1';
        foreach ($params as $key => $param) {
            $where .= ' AND ' . $key . ' = :' . $key;
        }
        $skipClausule = "";
        if ($skip !== null) {
            $skipClausule = " LIMIT " . ITEMS_PER_PAGINATION . " OFFSET " . $skip;
        }
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $where . $skipClausule;
        $request = $this->pdo->prepare($sql);

        if ($request->execute($params)) {
            return $request->fetchAll();
        }
        return false;
    }
    
    public function updateBy($conditions, $args) {
        $sql = 'UPDATE ' . $this->tableName . ' SET ';
        $sets = [];
        foreach($args as $key => $value) {
            $sets[] = $key . ' = :' . $key;
        }
        $sql .= implode(', ', $sets);
        $sql .= ' WHERE ';
        $wheres = [];
        foreach($conditions as $key => $value) {
            $wheres[] = $key . ' = :' . $key;
        }
        $sql .= implode(' && ', $wheres);
        echo $sql;
        $statement = $this->pdo->prepare($sql);
        foreach($args as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        foreach($conditions as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        $statement->execute();
    }
    public function deleteBy($field, $value) {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
    }
  /*  protected function getValue($param, $whereParams = array()) {
        $where = '1';
        foreach ($whereParams as $key => $keyData) {
            $where .= ' AND ' . $key . ' = :' . $key;
        }
        $sql = 'SELECT ' . $param . ' FROM ' . $this->tableName . ' WHERE ' . $where;
        $request = $this->pdo->prepare($sql);

        if ($request->execute($whereParams)) {
            return $request->fetchColumn();
        }
        return false;
    }
    */

}

?> 