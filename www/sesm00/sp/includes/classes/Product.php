<?php


class Product extends Model
{

    protected const TABLE_NAME = PRODUCTS_TABLE;
    protected $attrMap = [
        "name",
        "description",
        "price",
        "type",
        "categories_id",
    ];

    public static $objectCache = [];

    public $name;
    public $description;
    public $price;
    public $type;
    public $categories_id;

    public function __construct($id, $name = "", $description = "", $price = 0.00, $type = 1, $categories_id = 1)
    {
        parent::__construct($id);

        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->type = $type;
        $this->categories_id = $categories_id;
    }

    public static function getProductsByCategory($categoryId) {
        $rows = Database::getInstance()->selectQ('SELECT id FROM ' .
            self::TABLE_NAME .
            " WHERE categories_id = :categories_id", array('categories_id' => $categoryId));

        $products = array();

        foreach ($rows as $row) {
            $product = Product::getInstance($row['id']);
            if ($product->load()) {
                $products[] = $product;
            }
        }

        return $products;
    }

    public function getFormatedPrice() {
        return formatPrice($this->price);
    }

    public function validate()
    {
        // TODO: Implement validate() method.
    }
}