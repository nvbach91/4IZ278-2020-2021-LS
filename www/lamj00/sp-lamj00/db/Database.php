<?php

include_once "global_constants.php";


abstract class Database {
    protected $pdo;
    protected $tableName;

    protected function init_database(){
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            DB_USER,
            DB_PASSWORD,
            $options
        );

    }
    /*
     * Returns all items in a table.
     */
    public function fetchAll(): array{
        $sql = "SELECT * FROM $this->tableName";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchSome(int $index, int $howMany): array{
        $this->pdo->query("SELECT COUNT(ID) FROM $this->tableName")->fetchColumn();
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY ID DESC LIMIT ? OFFSET ?");
        $stmt->bindValue(1, $howMany,  PDO::PARAM_INT);
        $stmt->bindValue(2, $index,  PDO::PARAM_INT);
        $stmt->execute();
        $items = $stmt->fetchAll();
        //var_dump($items);
        return $items;
    }
    /*
     * Returns item if there is found item with corresponding value in corresponding column.
     */
    public function getItem(string $column_name, $value){
        $table = $this->fetchAll();
        foreach (array_values($table)as $item){
            if($item[$column_name] === $value){
                return $item;
            }
        }
        return false;
    }
    /*
     * Deletes item according to item id in a specified table.
     */
    public function deleteItem(int $id): bool{
        $sql = "DELETE FROM $this->tableName WHERE ID=?";
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([$id]);
    }
    /*
     * Updates 1 value in 1 item in 1 table in database. Value is found according to item id, table name and column name.
     */
    public function updateItem(int $item_id, string $column_name, $value): array{
        $sql = "UPDATE $this->tableName SET ?=? WHERE ID=?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$column_name,$value,$item_id]);
        return $statement->fetchAll();
    }
    /*
     * Ads 1 item into table
     */
    public function addItem(array $values){
        $columns = $this->getColumnNames();
        $sql = "INSERT INTO $this->tableName (";
        foreach ($columns as $column){
            if($column["COLUMN_NAME"] != "ID")
                $sql .= $column["COLUMN_NAME"] .", ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= ") VALUES (";
        foreach ($values as $value){
            $sql .= "?, ";
        }
        $sql = substr($sql, 0, -2);
        $sql .=");";
        $statement = $this->pdo->prepare($sql);
        if($statement->execute($values)) {
            $last_id = $this->pdo->lastInsertId();
            return $last_id;
        }else return false;
    }
    public function getColumnNames(): array{
        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'eshop' AND TABLE_NAME = '$this->tableName'";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
}
