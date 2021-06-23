<?php require_once __DIR__ . '/db.php'; ?>
<?php

class ProductsDB extends Database {
    protected $tableName = 'products';

    public function fetchNew() {
        $sql = "SELECT * FROM $this->tableName ORDER BY id DESC LIMIT 4";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchDisplayProducts() {
        $sql = "SELECT * FROM $this->tableName ORDER BY id ASC LIMIT 3";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchAllProducts($nItems, $offset) {
        $sql = "SELECT * FROM $this->tableName LIMIT $nItems OFFSET ?;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function fetchCategoryProducts($nameCategory, $nItems, $offset) {
        $sql = "SELECT * FROM $this->tableName WHERE categories_id IN (SELECT id from categories WHERE name = '$nameCategory') LIMIT $nItems OFFSET ?;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countAllProducts() {
        $sql = "SELECT COUNT(id) FROM $this->tableName";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();;
        return $statement->fetchColumn();
    }

    public function countCategoryProducts($nameCategory) {
        $sql = "SELECT COUNT(id) FROM $this->tableName WHERE categories_id IN (SELECT id from categories WHERE name = '$nameCategory')";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();;
        return $statement->fetchColumn();
    }

    public function fetchCartProducts($question_marks, $ids) {
        $sql = "SELECT * FROM products WHERE id IN ($question_marks) ORDER BY name";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array_values($ids));
        return $statement->fetchAll();
    }

    public function sumPrice($question_marks, $ids) {
        $sql = "SELECT SUM(price) FROM products WHERE id IN ($question_marks)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array_values($ids));;
        return $statement->fetchColumn();
    }

    public function findProduct($id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(
            ['id' => $id
        ]);
        return $statement->fetch();
    }
}
?>