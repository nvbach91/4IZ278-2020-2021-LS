<?php require __DIR__ . '/database.php'; ?>
<?php

class CategoryDB extends Database {
    protected $tableName = 'Category';

    public function delete() {
        $id = @$_GET['id'];

        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE category_id=:id;';
        $statement = $this->databaseObject->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);
    }
}

?>