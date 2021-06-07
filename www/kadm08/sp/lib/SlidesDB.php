<?php require_once __DIR__ . '/Database.php'; ?>

<?php

class SlidesDB extends Database
{
    protected $tableName = 'slides';


    public function fetchAllItems()
    {
        $sql = "SELECT * FROM slides";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($item)
    {
        $sql = 'INSERT INTO ' . $this->tableName . '(img, title) VALUES (:img, :title)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'img' => $item['img'],
            'title' => $item['title'],
        ]);
    }

    public function fetchBy($id, $value)
    {
        $sql = 'SELECT * FROM ' . $this->tableName .  ' WHERE ' . $id . ' = :value';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
        return $statement->fetchAll();
    }
}

?>