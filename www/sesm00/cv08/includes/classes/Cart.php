<?php

class Cart
{
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
        $productsDB = new ProductsDB();
        $product = $productsDB->fetchBy(array('where' => array('id' => $id)))[0];
        array_push($this->products, $product);
        $this->saveCart();
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
        $total = 0;
        foreach ($this->getProducts() as $product) {
            $total += $product['price'];
        }
        return $total;
    }

}