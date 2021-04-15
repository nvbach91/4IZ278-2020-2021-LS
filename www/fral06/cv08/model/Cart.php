<?php


class Cart
{
    private $products;
    public function __construct($ids)
    {
        $this->products = [];
        $this->productsDB = new ProductsDB();
        foreach ($ids as $id) {
            $this->addToCart($id);
        }
    }

    public function addToCart($id) {

        $product = $this->productsDB->fetchById($id);
        array_push($this->products, $product);
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