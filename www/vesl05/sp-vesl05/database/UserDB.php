<?php require __DIR__ . '/database.php'; ?>
<?php

class UserDB extends Database {
    protected $tableName = 'User';

    public function delete() {
        $id = @$_GET['id'];

        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE user_id=:id;';
        $statement = $this->databaseObject->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);
    }
}

?>