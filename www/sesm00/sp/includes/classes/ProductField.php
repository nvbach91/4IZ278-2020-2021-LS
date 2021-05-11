<?php


class ProductField extends Model
{

    protected const TABLE_NAME = DB_PREFIX . "order_product_fields";
    protected $attrMap = [
        "registration_plate",
        "valid",
        "notified",
        "states_id",
        "order_products_id",
    ];

    public $registration_plate;
    public $valid;
    public $notified;
    public $states_id;
    public $order_products_id;

    public function __construct($id)
    {
        parent::__construct($id);
    }

}