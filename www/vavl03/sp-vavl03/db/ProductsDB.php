<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class ProductsDB extends Database
{
    protected $tableName = 'product';
    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchCartProducts($question_marks, $productIds)
    {
        $sql = "SELECT * FROM product WHERE product_id IN ($question_marks) ORDER BY product_name";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_values($productIds));
        $products = $stmt->fetchAll();
        return $products;
    }
    public function fetchCartProductsPrice($question_marks, $productIds)
    {
        $sql = "SELECT SUM(product_price) FROM product WHERE product_id IN ($question_marks)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_values($productIds));
        $sum = $stmt->fetchColumn();
        return $sum;
    }
    public function fetchProductsByPagination($nItemsPerPagination, $offset)
    {
        // load only unreserved products
        $statement = $this->pdo->prepare("SELECT * FROM product WHERE order_order_id IS NULL GROUP BY product_name ORDER BY product_id
        DESC LIMIT $nItemsPerPagination OFFSET ? ");
        $statement->bindValue(1, $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchCountedProducts()
    {
        $sql = 'SELECT COUNT(product_id) FROM product WHERE `order_order_id` IS NULL GROUP BY product_name ';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function fetchById($id)
    {
        $sql = "SELECT * FROM product WHERE product_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    public function fetchProductPcs($productName)
    {
        $sql = "SELECT COUNT(product_id) FROM product WHERE product_name = :name AND `order_order_id` IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['name' => $productName]);
        return $stmt->fetchColumn();
    }
    public function fetchProductPrice($productName)
    {
        $sql = "SELECT product_price FROM product WHERE product_name = :name";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['name' => $productName]);
        return $stmt->fetchColumn();
    }
    public function fetchProductIds($productId, $pcs)
    {
        $sql = "SELECT `product_id` FROM `product` WHERE `product_name` = (SELECT product_name FROM product WHERE product_id = :productId)
        AND `order_order_id` IS NULL LIMIT :pcs";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'productId' => $productId,
            'pcs' => $pcs
        ]);
        return $stmt->fetchAll();
    }
    public function deleteOrderId($orderId)
    {
        $sql = "UPDATE `product` SET `order_order_id` = NULL WHERE order_order_id = :orderId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['orderId' => $orderId]);
    }
    public function fetchProductsByCategory($categoryName, $nItemsPerPagination, $offset)
    {
        $statement = $this->pdo->prepare("SELECT *
        FROM product u
        INNER JOIN product_has_category uht
        ON u.product_id = uht.product_product_id
        INNER JOIN category t
        ON uht.category_category_id = t.category_id
        WHERE t.category_name = :category AND u.order_order_id IS NULL
        GROUP BY u.product_name
        ORDER BY u.product_id
        DESC LIMIT :nItemsPerPage 
        OFFSET :offset");
        $statement->execute(['category' => $categoryName, 'nItemsPerPage' => $nItemsPerPagination, 'offset' => $offset]);
        return $statement->fetchAll();
    }
    public function fetchCountedCategoryProducts($categoryName)
    {
        $sql = "SELECT COUNT(u.product_id)
        FROM product u
        INNER JOIN product_has_category uht
        ON u.product_id = uht.product_product_id
        INNER JOIN category t
        ON uht.category_category_id = t.category_id
        WHERE t.category_name = :category AND u.order_order_id IS NULL
        GROUP BY u.product_name";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['category' => $categoryName]);
        return $stmt->fetchAll();
    }
    public function fetchProductsByOrder($orderId)
    {
        $sql = "SELECT * FROM `product` WHERE order_order_id = :orderId GROUP BY product_name";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['orderId' => $orderId]);
        return $stmt->fetchAll();
    }
    public function fetchOrderProductPcs($productName, $orderId)
    {
        $sql = "SELECT COUNT(product_id) FROM product WHERE product_name = :productName AND `order_order_id` = :orderId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'productName' => $productName,
            'orderId' => $orderId
        ]);
        return $stmt->fetchColumn();
    }
}

?>