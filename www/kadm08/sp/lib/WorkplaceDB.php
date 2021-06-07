<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class WorkplaceDB extends Database
{
    public function fetchAllItems()
    {
        $sql = "SELECT * FROM workplace ORDER BY ws_id ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function fetchById($id)
    {
        $sql = "SELECT * FROM workplace WHERE ws_id = :ws_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['ws_id' => $id]);
        return $stmt->fetch();
    }

    public function createItem($name, $price_per_day, $active)
    {
        $sql = "INSERT INTO workplace (name, price_per_day, active, last_updated_at) VALUES (:name, :price_per_day, :active, NOW())";
        $stmt = $this->pdo->prepare($sql);


        $stmt->execute([
            "name" => $name,
            "price_per_day" => $price_per_day,
            "active" => $active,
        ]);
    }

    public function deleteItem($id)
    {
        $sql = "DELETE FROM workplace WHERE ws_id = :ws_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['ws_id' => $id]);
    }

    public function updateItem($id, $name, $price_per_day)
    {
        $sql = "UPDATE workplace SET name = :name, price_per_day = :price WHERE ws_id = :ws_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'ws_id' => $id,
            'name' => $name,
            'price' => $price_per_day
        ]);
    }
}

?>