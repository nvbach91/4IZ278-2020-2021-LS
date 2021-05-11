<?php


class Category extends Model
{

    protected $tableName = DB_PREFIX . "categories";
    protected $attrMap = [
        "name",
    ];

    public $name;

    public function __construct($id)
    {
        parent::__construct($id);
    }

}