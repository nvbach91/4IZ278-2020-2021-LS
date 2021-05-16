<?php require __DIR__ . '/database.php'; ?>
<?php

class ArtistDB extends Database {
    protected $tableName = 'Artist';

    public function delete() {
        $id = @$_GET['id'];

        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE artist_id=:id;';
        $statement = $this->databaseObject->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);
    }
}

?>