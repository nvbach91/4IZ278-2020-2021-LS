<?php

namespace cv05\implementations;

use cv05\Database;
use cv05\DatabaseConfiguration;

final class ProductsDatabase extends Database
{
    public function __construct() {
        parent::__construct(new DatabaseConfiguration(
            "/app/database/products",
            ".db",
            ";"
        ));
    }

    public function create(array $parameters) {
        $serialized = json_encode($parameters);
        $this->log("Created product with parameters: [$serialized].");
    }

    public function fetch() {
        $this->log("Fetched the product from database.");
    }

    public function save() {
        $this->log("Saved the product to database.");
    }

    public function delete() {
        $this->log("Deleted the product from database.");
    }
}