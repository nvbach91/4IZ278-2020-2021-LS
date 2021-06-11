<?php


class State extends Model
{

    protected const TABLE_NAME = STATES_TABLE;
    protected $attrMap = [
        "name",
        "code",
    ];

    public static $objectCache = [];

    public $name;
    public $code;

    public function __construct($id)
    {
        parent::__construct($id);
    }

    public function validate(){}
}