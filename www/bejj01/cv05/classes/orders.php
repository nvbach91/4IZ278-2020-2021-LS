<?php

require_once  __DIR__ . '/database.php';

class OrdersDB extends AbstractDatabase {
    public function __construct($keys, $idIndex) {
        parent::__construct('/orders', $keys, $idIndex);
    }

    public function create($args) {
        $keys = array_keys($args);
        if ( count($args) !== count($this->columns) && !empty(array_diff($keys, $this->columns)) ) {
            echo 'Order cannot be created. Wrong parameters entered.', nl2br("\n");
            return;
        }

        $orders = $this->getAllData($this->idIndex, $this->columns);

        if (key_exists($args[$this->columns[$this->idIndex]], $orders)) {
            $this->outputAlreadyExistingIdMessage('Order', $args);
            return;
        }

        $this->createRecord($args);

        echo 'New order was created with parameters: ', $this->outputOrderData($args), nl2br("\n");
    }

    public function fetch($orderId) {
        $order = $this->getRecord($orderId, $this->idIndex, $this->columns);
        if ($order) {
            echo 'An order ', $order['id'] ,' was fetched. Order\'s data: ', $this->outputOrderData($order), nl2br("\n");
        }
        else {
            $this->outputNotFoundIdMessage('Fetch', 'Order', $orderId);
        }
        
    }

    public function update($orderId, $updatedValues) {
        $order = $this->getRecord($orderId);

        if ($order) {
            $updatedOrder = $this->getUpdatedRecord($order, $updatedValues);
            if (!$updatedOrder) {
                echo 'You are trying to update non-existent order columns data.', nl2br("\n");
            }
            else {
                echo 'Order data for order ', $order['id'], ' was updated. New data: ', $this->outputOrderData($updatedOrder), nl2br("\n");
            }
        }
        else {
            $this->outputNotFoundIdMessage('Update', 'Order', $orderId);
        }
    }

    public function delete($orderId) {
        if ($this->removeRecord($orderId)) {
            echo 'An order with id: ', $orderId, ' was deleted', nl2br("\n");
        }
        else {
            $this->outputNotFoundIdMessage('Delete', 'Order', $orderId);
        }
    }

    private function outputOrderData($order) {
        return '[ Id: ' .  $order['id'] . ', User: ' . $order['user'] . ', Price: ' .  $order['price'] . ' ]';
    }
}

$orders = new OrdersDB(['id', 'user', 'price'], 0);

// clear data files before, only for testing purpose
$orders->clear();
$orders->create(['id' => 'O01', 'user' => 'SomeUser01', 'price' => '1000 CZK']);
// could not create order with same id
$orders->create(['id' => 'O01', 'user' => 'AnotherUser02', 'price' => '500 USD']);
$orders->create(['id' => 'O02', 'user' => 'BeardyBear22', 'price' => '50 CZK']);
$orders->create(['id' => 'O03', 'user' => 'CrazyCapybara', 'price' => '550 CZK']);
// will fetch order
$orders->fetch('O02');
// cannot delete non existent order
$orders->delete('nonsenseID');
// should delete
$orders->delete('O01');
// order was deleted -> fetch should fail
$orders->fetch('O01');
// should update values
$orders->update('O02', ['price' => '800 EUR']);
// wrong column id -> fail
$orders->update('O02', ['coconut' => '800 EUR']);

?>