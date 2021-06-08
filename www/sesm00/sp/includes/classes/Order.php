<?php


class Order extends Model
{

    protected const TABLE_NAME = ORDER_TABLE;
    protected $attrMap = [
        "datetime",
        "total",
        "users_id",
        "delivery_addresses_id",
        "payed",
        "payment_method",
        "delivery_type"
    ];

    public static $objectCache = [];

    public $datetime;
    public $total;
    public $users_id;
    public $delivery_addresses_id;
    public $payed;
    public $payment_method;
    public $delivery_type;

    public function __construct($id, $total = 0, $user_id = 0, $delivery_addresses_id = 0, $payment_method = 0, $delivery_type = 0)
    {
        $this->datetime = getCurrentFormatedTime();
        $this->total = $total;
        $this->users_id = $user_id;
        $this->delivery_addresses_id = $delivery_addresses_id;
        $this->payed = 0;
        $this->payment_method = $payment_method;
        $this->delivery_type = $delivery_type;

        parent::__construct($id);
    }

    public function validate()
    {
        return array('success' => true);
    }
}