<?php


class Order extends Model
{

    protected const TABLE_NAME = DB_PREFIX . "orders";
    protected $attrMap = [
        "datetime",
        "total",
        "users_id",
        "delivery_addresses_id",
    ];

    public $datetime;
    public $total;
    public $users_id;
    public $delivery_addresses_id;

    public function __construct($id)
    {
        parent::__construct($id);
    }

}