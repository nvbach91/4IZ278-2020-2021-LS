<?php


class OrdersDB extends Database
{
    protected $file = "Orders";

    public function fetch($args)
    {
        $orders = $this->readDatabase();
        foreach ($orders as $order)
        {
            if($order[0]==$args['id']){
                echo "Order ", $args['id'], " was fetched", PHP_EOL;
                echo "ID: ", $order[0], " Total: ", $order[1], " Date: ", $order[2], PHP_EOL;
                return;
            }
        }
        echo "Order does not exist", PHP_EOL;
    }

    public function create($args)
    {
        $orders = $this->readDatabase();
        foreach ($orders as $order) {
            if ($order[0] == $args['id']) {
                echo "Order with this ID is already created!";
                return;
            }
        }
        array_push($orders, array($args['id'], $args['total'], $args['date']));
        $this->writeDatabase($orders);
        echo "Order with id ", $args['id'], ", price ", $args['total'], " and date ", $args['date'], " was created", PHP_EOL;
    }

    public function update($args)
    {
        $orders = $this->readDatabase();
        $i = 0;
        foreach ($orders as $order) {
            if ($order[0]==$args['id']){
                unset($orders[$i]);
                array_push($orders, $args);   
                $this->writeDatabase($orders);
                echo "Order ", $args['id'], " was updated", PHP_EOL;
                return;
            }
            $i++;
        }
        echo "Order does not exist", PHP_EOL;
    }

    public function delete($args)
    {
        $orders = $this->readDatabase();
        $i = 0;
        foreach ($orders as $order) {
            if ($order[0]==$args['id']){
                unset($orders[$i]);   
                $this->writeDatabase($orders);
                echo "Order ", $args['id'], " was deleted", PHP_EOL;
                return;
            }
            $i++;
        }
        echo "Order does not exist", PHP_EOL;
    }
}
?>