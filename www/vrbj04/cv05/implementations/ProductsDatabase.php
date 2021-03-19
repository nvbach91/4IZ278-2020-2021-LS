<?php

namespace cv05\implementations;

use cv05\Database;
use cv05\DatabaseConfiguration;

final class ProductsDatabase extends Database
{
    public function __construct() {
        parent::__construct(new DatabaseConfiguration(
            "/database/products",
            ".db",
            ";"
        ));
    }

    public function create(array $parameters) {
        $products = $this->loadDatabaseItems();
        $products[] = $parameters;

        $this->storeDatabaseItems($products);
    }

    public function fetch(int $id) {
        $products = $this->loadDatabaseItems();
        $matching = array_filter($products, function ($item) use ($id) { return $item[0] == $id; });

        if (count($matching) === 0) {
            return null;
        }

        return array_values($matching)[0];
    }

    public function save(int $id, array $parameters) {
        $products = $this->loadDatabaseItems();

        foreach ($products as $index => $product) {
            if ($product[0] == $id) {
                $products[$index] = $parameters;
            }
        }

        $this->storeDatabaseItems($products);
    }

    public function delete(int $id) {
        $products = $this->loadDatabaseItems();
        $others = array_filter($products, function ($item) use ($id) { return $item[0] != $id; });

        $this->storeDatabaseItems(array_values($others));
    }
}