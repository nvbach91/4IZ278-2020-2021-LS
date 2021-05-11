<?php


class State extends Model
{

    protected const TABLE_NAME = DB_PREFIX . "states";
    protected $attrMap = [
        "name",
        "code",
    ];

    public $name;
    public $code;

    public function __construct($id)
    {
        parent::__construct($id);
    }

}