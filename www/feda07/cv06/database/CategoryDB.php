<?php
require_once __DIR__ . '/Database.php';

class CategoryDB extends ADatabase
{

    function getTableName(): string
    {
        return "categories";
    }
}