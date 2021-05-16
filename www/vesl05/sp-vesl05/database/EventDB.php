<?php require __DIR__ . '/database.php'; ?>
<?php

class EventDB extends Database {
    protected $tableName = 'Event';

    public function delete() {
        $id = @$_GET['id'];

        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE event_id=:id;';
        $statement = $this->databaseObject->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);
    }
}

?>