<?php

class ProductsDB extends Database
{
    function __construct()
    {
        parent::__construct('products');
    }

    public function create($item)
    {
        parent::create($item);
        echo 'A new product was created.', PHP_EOL;
    }

    public function fetch()
    {
        $products = parent::fetch();
        echo 'The products were fetched.', PHP_EOL;
        print_r($products);
        return $products;
    }

    public function save($id, $item)
    {
        parent::save($id, $item);
        echo 'A product was updated.', PHP_EOL;
    }

    public function delete($id)  
    { 
        parent::delete($id);
        echo 'A product was deleted.', PHP_EOL; 
    }
}
