<?php


class OrderProduct extends Model
{
    protected const TABLE_NAME = ORDER_PRODUCT_TABLE;
    protected $attrMap = [
        "unit_price",
        "quantity",
        "products_id",
        "orders_id"
    ];

    public static $objectCache = [];

    public $unit_price;
    public $quantity;
    public $products_id;
    public $orders_id;

    public function __construct($id, $unit_price = 0, $quantity = 1, $products_id = 0, $orders_id = 0)
    {
        $this->unit_price = $unit_price;
        $this->quantity = $quantity;
        $this->products_id = $products_id;
        $this->orders_id = $orders_id;

        parent::__construct($id);
    }

    public function validate(){}

    public static function validateProductsAndFields($cartProducts, $productFields) {

        foreach ($cartProducts as $prodKey => $cartProduct) {
            if ($cartProduct->type == 2) {
                $valid = true;
                if (is_array($productFields[$prodKey])) {
                    if (!isset($productFields[$prodKey]['spz']) || strlen($productFields[$prodKey]['spz']) < 5) {
                        $valid = false;
                    }
                    if (!isset($productFields[$prodKey]['state']) || !is_numeric($productFields[$prodKey]['state']) ||
                        !($productFields[$prodKey]['state'] > 0 && $productFields[$prodKey]['state'] < 251)) {
                        $valid = false;
                    }
                } else {
                    $valid = false;
                }
                if (!$valid) {
                    return array('success' => false, 'msg' => "Je třeba vyplnit pole u všech produktů");
                }
            }
        }

        return array('success' => true);

    }

    public static function createByCartProducts($cartProducts, $productFields, $order_id) {
        $finalProducts = array();
        foreach ($cartProducts as $prodKey => $product) {
            if ($product->type == 2) {
                // 4 rok 5 30 dní 6 10 dní
                $dateTime = new DateTime(null, new DateTimeZone(TIME_ZONE));
                if ($product->getId() == 4) {
                    $dateTime->modify("+1 year");
                } else if ($product->getId() == 5) {
                    $dateTime->modify("+30 day");
                } else if ($product->getId() == 6) {
                    $dateTime->modify("+10 day");
                } else {
                    trigger_error("Product validity not defined");
                }
                $date = $dateTime->format("Y-m-d");
                $finalProduct = new OrderProduct(-1, $product->price, 1, $product->getId(), $order_id);
                $finalProduct->create();
                $finalField = new ProductField(-1, $productFields[$prodKey]["spz"], $date, 0, $productFields[$prodKey]["state"], $finalProduct->getId());
                $finalField->create();

            } else {
                $found = false;
                foreach ($finalProducts as $key => $finalProduct) {
                    if ($finalProduct->products_id == $product->getId()) {
                        $found = $key;
                        break;
                    }
                }
                if ($found === false) {
                    $finalProducts[] = new OrderProduct(-1, $product->price, 1, $product->getId(), $order_id);
                } else {
                    $finalProducts[$found]->quantity++;
                }
            }
        }

        foreach ($finalProducts as $product) {
            $product->create();
        }
    }

    public static function getProductsByOrderId($order_id) {
        $results = Database::getInstance()->selectQ("SELECT id FROM " . self::TABLE_NAME . " WHERE orders_id = :orders_id", array('orders_id' => $order_id));
        $objects = array();
        foreach ($results as $result) {
            $object = self::getInstance($result['id']);
            if ($object->load()) {
                $objects[] = $object;
            }
        }

        return $objects;
    }

    public function getProductField() {
        $product = ProductField::getFieldByProductId($this->getId());
        if ($product == false) {
            return false;
        }
        $product->load();
        return $product;
    }

    public function getBaseProduct() {
        $product = Product::getInstance($this->products_id);
        $product->load();
        return $product;
    }

}