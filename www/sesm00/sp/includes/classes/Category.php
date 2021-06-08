<?php


class Category extends Model
{

    protected const TABLE_NAME = CATEGORIES_TABLE;
    protected $attrMap = [
        "name",
    ];

    public static $objectCache = [];

    public $name;

    public function __construct($id, $name = "")
    {
        parent::__construct($id);

        $this->name = $name;
    }

    public function getProducts() {
        return Product::getProductsByCategory($this->id);
    }

    public function validate()
    {
        // TODO: Implement validate() method.
    }
}