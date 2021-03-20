<?php


class OrdersDB extends Database
{
    protected $file = "orders";

    public function fetch($args)
    {
        $order = $this->readDatabase()[$args['id']];
        if (isset($order)) {
            echo "Order ", $args['id'], " was fetched", PHP_EOL;
            echo "Number: ", $order[0], " Total: ", $order[1], " Tax: ", $order[2], PHP_EOL;
        } else {
            echo "Order does not exist", PHP_EOL;
        }
    }

    public function create($args)
    {
        $orders = $this->readDatabase();
        array_push($orders, array($args['number'], $args['total'], $args['tax']));
        $this->writeDatabase($orders);
        echo "Order with number ", $args['number'], ", price ", $args['total'], " and tax ", $args['tax'], " was created", PHP_EOL;
    }

    public function update($args)
    {
        $orders = $this->readDatabase();
        if (isset($orders[$args['id']])) {
            $orders[$args['id']] = array_values($args['order']);
            $this->writeDatabase($orders);
            echo "Order ", $args['id'], " was updated", PHP_EOL;
        } else {
            echo "Order does not exist", PHP_EOL;
        }
    }

    public function delete($args)
    {
        $orders = $this->readDatabase();
        if (isset($orders[$args['id']])) {
            unset($orders[$args['id']]);
            $this->writeDatabase($orders);
            echo "Order with id ", $args['id'], " was deleted", PHP_EOL;
        } else {
            echo "Order does not exist", PHP_EOL;
        }
    }
}