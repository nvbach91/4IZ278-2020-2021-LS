<?php

class OrdersDB extends Database
{
    function __construct()
    {
        parent::__construct('orders');
    }

    public function create($item)
    {
        parent::create($item);
        echo 'A new order was created.', PHP_EOL;
    }

    public function fetch()
    {
        $orders = parent::fetch();
        echo 'The orders were fetched.', PHP_EOL;
        print_r($orders);
        return $orders;
    }

    public function save($id, $item)
    {
        parent::save($id, $item);
        echo 'An order was updated.', PHP_EOL;
    }

    public function delete($id)  
    { 
        parent::delete($id);
        echo 'An order was deleted.', PHP_EOL; 
    }
}
