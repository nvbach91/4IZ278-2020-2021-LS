<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class OrderDO extends Database {
    protected $tableName = 'ORDER';

    function listForUser($userId) {
        $this->find('ID_USER', $userId);
    }
}
?>