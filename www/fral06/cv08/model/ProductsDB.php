<?php

require_once __DIR__ . "/Database.php";

class ProductsDB extends Database
{
    public function productsCount()
    {
        $sql = "SELECT COUNT(product_id) FROM Products";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function fetch()
    {
        $sql = "SELECT * FROM Products";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Products where product_id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insertInto($name, $price, $madeIn, $img)
    {
        echo $name;
        $stmt = $this->db->prepare("INSERT INTO Products (`name`, `price`, `made_in`, `img`) VALUES (?, ? , ?, ?)");
        $stmt->execute([$name, $price, $madeIn, $img]);
        return $stmt->fetch();
    }

    public function fetchWithLimit($pagination, $offset)
    {
        $stmt = $this->db->prepare("SELECT * FROM Products ORDER BY product_id DESC LIMIT $pagination OFFSET ?");
        $stmt->bindValue(1, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deleteById($id)
    {
        $stmt = $this->db->prepare("DELETE FROM Products WHERE `product_id`= ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}