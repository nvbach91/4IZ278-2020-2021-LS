<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class OrderItemDO extends Database {
    protected $tableName = 'ORDER_ITEM';

    function listForOrder($orderId) {
        $this->find('ID_ORDER', $orderId);
    }
}
?>