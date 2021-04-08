<?php
require_once __DIR__ . '/Database.php';

class SlideDB extends ADatabase
{

    function getTableName(): string
    {
        return "slides";
    }
}