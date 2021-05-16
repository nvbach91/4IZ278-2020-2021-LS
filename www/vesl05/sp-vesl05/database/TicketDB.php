<?php require __DIR__ . '/database.php'; ?>
<?php

class TicketDB extends Database {
    protected $tableName = 'Ticket';

    public function delete() {
        $id = @$_GET['id'];

        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ticket_id=:id;';
        $statement = $this->databaseObject->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);
    }
}

?>