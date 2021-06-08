<?php

class Cart
{
    private static $cartTotal;

    private $products;

    public function __construct()
    {
        if (isset($_SESSION['cart'])) {
            $this->products = $_SESSION['cart'];
        } else {
            $this->products = array();
        }
    }

    private function saveCart() {
        $_SESSION['cart'] = $this->products;
    }

    public function addToCart($id) {
        $product = Product::getInstance($id);
        if ($product->load()) {
            $this->products[] = $product;
            $this->saveCart();
        }
    }

    public function removeFromCart($productCartId) {
        unset($this->products[$productCartId]);
        sort($this->products);
        $this->saveCart();
    }

    public function getProducts() {
        return $this->products;
    }

    public function getCartTotal() {
        if (self::$cartTotal === null) {
            $total = 0;
            foreach ($this->getProducts() as $product) {
                $total += $product->price;
            }
            self::$cartTotal = $total;
        }

        return self::$cartTotal;
    }

    public function clear() {
        $this->products = array();
        $this->saveCart();
    }

}