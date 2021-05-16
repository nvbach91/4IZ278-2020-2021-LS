<?php require __DIR__ . '/database.php'; ?>
<?php

class ArtistOnEventDB extends Database {
    protected $tableName = 'ArtistOnEvent';

    public function delete() {
        $id = @$_GET['id'];

        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE artistonevent_id=:id;';
        $statement = $this->databaseObject->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);
    }
}

?>