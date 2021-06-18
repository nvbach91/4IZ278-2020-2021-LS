<?php require_once __DIR__ . '/../config/global.php'; ?>
<?php require_once __DIR__ . '/DatabaseOperations.php'; ?>
<?php

abstract class Database implements DatabaseOperations
{
    protected $pdo;
    public function __construct()
    {
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            DB_USERNAME,
            DB_PASSWORD
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetch($id)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE id = :id;';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);
        return $statement->fetchAll()[0];
    }

    public function fetchByIds($ids)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE id IN (:ids);';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'ids' => implode(",", $ids),
        ]);
        return $statement->fetchAll();
    }

    public function fetchByCategory($categoryId)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE category_id = :category_id;';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'category_id' => $categoryId,
        ]);
        return $statement->fetchAll();
    }

    // parametrizace
    public function add($name, $price, $img, $description, $category)
    {
        $sql = 'INSERT INTO ' . $this->tableName  . ' (name, price, img, description, category_id)' . 'VALUES (:name, :price, :img, :description, :category );';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $name,
            'price' => $price,
            'img' => $img,
            'description' => $description,
            'category' => $category,
        ]);
        return "You have successfully added item " . $name;
    }

    public function update($id, $newName, $newPrice, $newImg, $newDescription)
    {
        $sql = 'UPDATE ' . $this->tableName . ' SET name = "' . $newName . '", price = ' . $newPrice . ', img = "' . $newImg . '", description = "' . $newDescription . '" WHERE id = ' . $id . ';';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return "You have successfully updated item " . $newName;
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE id = :id;';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);
        return "You have successfully deleted an item";
    }

    public function pessimisticUpdate($userId, $timestamp, $productId)
    {
        $sql = "UPDATE products SET edited_by = :user_id, opened_at = :timestamp WHERE id = :product_id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $userId,
            'timestamp' => $timestamp,
            'product_id' => $productId,
        ]);
    }

    public function addUser($email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO ' . $this->tableName  . ' (email, password) ' . 'VALUES (:email, :hashed_password);';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'email' => $email,
            'hashed_password' => $hashedPassword,
        ]);
    }

    public function updateRole($id, $newRole)
    {
        $sql = 'UPDATE ' . $this->tableName . ' SET admin = :newRole WHERE id = :id;';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['newRole' => $newRole, 'id' => $id]);
        return "You have successfully updated role for user " . $id;
    }

    public function createOrder($userId, $productId, $timestamp, $delivery, $payment)
    {
        $sql = 'INSERT INTO ' . $this->tableName  . ' (user_id, product_id, timestamp, payment, delivery) ' 
        . 'VALUES (:user_id, :product_id, :timestamp, :delivery, :payment);';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'user_id' => $userId,
            'product_id' => $productId,
            'timestamp' => $timestamp,
            'delivery' => $delivery,
            'payment' => $payment,
        ]);
    }

    public function fetchOrders($userId, $timestamp)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE user_id = :user_id AND DATE_FORMAT(timestamp, "%Y-%m-%d %H:%i:00") = :timestamp;';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'user_id' => $userId,
            'timestamp' => $timestamp,
        ]);
        return $statement->fetchAll();
    }

    public function fetchOrdersSeconds($userId, $timestamp)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE user_id = :user_id AND timestamp = :timestamp;';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'user_id' => $userId,
            'timestamp' => $timestamp,
        ]);
        return $statement->fetchAll();
    }

    public function fetchOrdersWithoutTimestamp($userId)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE user_id = :user_id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'user_id' => $userId,
        ]);
        return $statement->fetchAll();
    }
}

?>