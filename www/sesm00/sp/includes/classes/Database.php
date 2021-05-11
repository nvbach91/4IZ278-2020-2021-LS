<?php

class Database
{
    protected static $instance;

    public const SELECT_FAILED = "Provedení výběrového dotazu selhalo";
    public const INSERT_FAILED = "Provedení vkládacího dotazu selhalo";
    public const UPDATE_FAILED = "Provedení aktualizačního dotazu selhalo";
    public const DELETE_FAILED = "Provedení výmazového dotazu selhalo";

    private $pdo;

    private function __construct() {
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
            DB_USER,
            DB_PASS
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function select($tableName, $params = array(), $skip = null) {
        $where = '1';
        foreach ($params as $key => $param) {
            $where .= ' AND ' . $key . ' = :' . $key;
        }
        $skipClausule = "";
        if ($skip !== null) {
            $skipClausule = " LIMIT " . PRODUCTS_PER_PAGE . " OFFSET " . $skip;
        }
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE ' . $where . $skipClausule;
        $request = $this->pdo->prepare($sql);

        if ($request->execute($params)) {
            return $request->fetchAll();
        }
        return false;
    }

    public function selectQ($query) {
        $request = $this->pdo->query($query);
        if ($request->execute()) {
            return $request->fetchAll();
        }
        return false;
    }

    public function insert($tableName, $columns) {
        $params = "";
        $values = "";
        foreach ($columns as $key => $param) {
            $params .= ' ' . $key;
            $values .= ' :' . $key;
            if ($key != array_key_last($columns)) {
                $params .= ',';
                $values .= ',';
            }
        }

        $sql = 'INSERT INTO ' . $tableName . ' (' . $params . ') VALUES (' . $values . ')';
        $request = $this->pdo->prepare($sql);
        return $request->execute($columns);
    }

    public function update($tableName, $data, $whereParams) {
        $allParams = array_merge($data, $whereParams);
        $sumParams = count($data) + count($whereParams);
        if (count($allParams) != $sumParams) {
            throw new Exception("Cannot update data which u're searching in");
        }

        $params = "";
        foreach ($data as $key => $param) {
            $params .= ' ' . $key . ' = :' . $key;
            if ($key != array_key_last($data)) {
                $params .= ',';
            }
        }
        $where = '1';
        foreach ($whereParams as $key => $param) {
            $where .= ' AND ' . $key . ' = :' . $key;
        }
        $sql = 'UPDATE ' . $tableName . ' SET ' . $params . ' WHERE ' . $where;
        $request = $this->pdo->prepare($sql);
        return $request->execute($allParams);
    }

    public function delete($tableName, $params) {
        $where = '1';
        foreach ($params as $key => $param) {
            $where .= ' AND ' . $key . ' = :' . $key;
        }
        $sql = 'DELETE FROM ' . $tableName . ' WHERE ' . $where;
        $request = $this->pdo->prepare($sql);
        return $request->execute($params);
    }

    public function getValue($tableName, $param, $whereParams = array()) {
        $where = '1';
        foreach ($whereParams as $key => $keyData) {
            $where .= ' AND ' . $key . ' = :' . $key;
        }
        $sql = 'SELECT ' . $param . ' FROM ' . $tableName . ' WHERE ' . $where;
        $request = $this->pdo->prepare($sql);

        if ($request->execute($whereParams)) {
            return $request->fetchColumn();
        }
        return false;
    }

    public function query($query) {
        $request = $this->pdo->query($query);
        return $request->execute();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

}