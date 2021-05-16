<?php require __DIR__ . '/database.php'; ?>
<?php

class PlaceDB extends Database {
    protected $tableName = 'Place';

    public function delete() {
        $id = @$_GET['id'];

        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE place_id=:id;';
        $statement = $this->databaseObject->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);
    }
}

?>