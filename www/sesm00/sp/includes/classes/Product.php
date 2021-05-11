<?php


class Product extends Model
{

    protected const TABLE_NAME = DB_PREFIX . "products";
    protected $attrMap = [
        "name",
        "type",
        "categories_id",
    ];

    public $name;
    public $type;
    public $categories_id;

    public function __construct($id)
    {
        parent::__construct($id);
    }

}