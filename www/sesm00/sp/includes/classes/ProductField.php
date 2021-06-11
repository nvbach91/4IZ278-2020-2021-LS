<?php


class ProductField extends Model
{

    protected const TABLE_NAME = ORDER_PRODUCT_FIELDS_TABLE;
    protected $attrMap = [
        "registration_plate",
        "valid",
        "notified",
        "states_id",
        "order_products_id",
    ];

    public static $objectCache = [];

    public $registration_plate;
    public $valid;
    public $notified;
    public $states_id;
    public $order_products_id;

    public function __construct($id, $registration_plate = "", $valid = "", $notified = 0, $states_id = 0, $order_products_id = 0)
    {
        $this->registration_plate = $registration_plate;
        $this->valid = $valid;
        $this->notified = $notified;
        $this->states_id = $states_id;
        $this->order_products_id = $order_products_id;

        parent::__construct($id);
    }

    public function validate(){}

    public static function getFieldByProductId($products_id) {
        $results = Database::getInstance()->selectQ("SELECT id FROM " . self::TABLE_NAME . " WHERE order_products_id = :order_products_id", array('order_products_id' => $products_id));
        if (isset($results[0])) {
            return self::getInstance($results[0]['id']);
        }

        return false;
    }

    public function getState() {
        $state = State::getInstance($this->states_id);
        $state->load();
        return $state;
    }
}