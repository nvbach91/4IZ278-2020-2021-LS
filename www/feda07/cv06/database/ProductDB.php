<?php
require_once __DIR__ . '/Database.php';

class ProductDB extends ADatabase
{

    function getTableName(): string
    {
        return "products";
    }
}