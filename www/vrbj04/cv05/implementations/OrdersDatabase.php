<?php

namespace cv05\implementations;

use cv05\Database;
use cv05\DatabaseConfiguration;

final class OrdersDatabase extends Database
{
    public function __construct() {
        parent::__construct(new DatabaseConfiguration(
            "/app/database/orders",
            ".db",
            ";"
        ));
    }

    public function create(array $parameters) {
        $serialized = json_encode($parameters);
        $this->log("Created orders with parameters: [$serialized].");
    }

    public function fetch() {
        $this->log("Fetched the orders from database.");
    }

    public function save() {
        $this->log("Saved the orders to database.");
    }

    public function delete() {
        $this->log("Deleted the orders from database.");
    }
}