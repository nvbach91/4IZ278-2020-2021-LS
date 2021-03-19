<?php

namespace cv05\implementations;

use cv05\Database;
use cv05\DatabaseConfiguration;

final class OrdersDatabase extends Database
{
    public function __construct() {
        parent::__construct(new DatabaseConfiguration(
            "/database/orders",
            ".db",
            ";"
        ));
    }


    public function create(array $parameters) {
        $orders = $this->loadDatabaseItems();
        $orders[] = $parameters;

        $this->storeDatabaseItems($orders);
    }

    public function fetch(int $id) {
        $orders = $this->loadDatabaseItems();
        $matching = array_filter($orders, function ($item) use ($id) { return $item[0] == $id; });

        if (count($matching) === 0) {
            return null;
        }

        return array_values($matching)[0];
    }

    public function save(int $id, array $parameters) {
        $orders = $this->loadDatabaseItems();

        foreach ($orders as $index => $order) {
            if ($order[0] == $id) {
                $orders[$index] = $parameters;
            }
        }

        $this->storeDatabaseItems($orders);
    }

    public function delete(int $id) {
        $orders = $this->loadDatabaseItems();
        $others = array_filter($orders, function ($item) use ($id) { return $item[0] != $id; });

        $this->storeDatabaseItems(array_values($others));
    }
}