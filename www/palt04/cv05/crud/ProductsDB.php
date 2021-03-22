<?php


class ProductsDB extends Database
{
    protected $file = "Products";

    public function fetch($args)
    {
        $products = $this->readDatabase();
        foreach ($products as $product)
        {
            if($product[0]==$args['id']){
                echo "Product ", $args['id'], " was fetched", PHP_EOL;
                echo "ID: ", $product[0], " Name: ", $product[1], " Price: ", $product[2], PHP_EOL;
                return;
            }
        }
        echo "Product does not exist", PHP_EOL;
    }

    public function create($args)
    {
        $products = $this->readDatabase();
        foreach ($products as $product) {
            if ($product[0] == $args['id']) {
                echo "Product with this ID is already created!";
                return;
            }
        }
        array_push($products, array($args['id'], $args['name'], $args['price']));
        $this->writeDatabase($products);
        echo "Product with id ", $args['id'], ", name ", $args['name'], " and price ", $args['price'], " was created", PHP_EOL;
    }

    public function update($args)
    {
        $products = $this->readDatabase();
        $i = 0;
        foreach ($products as $product) {
            if ($product[0]==$args['id']){
                unset($products[$i]);
                array_push($products, $args);   
                $this->writeDatabase($products);
                echo "Product ", $args['id'], " was updated", PHP_EOL;
                return;
            }
            $i++;
        }
        echo "Product does not exist", PHP_EOL;
    }

    public function delete($args)
    {
        $products = $this->readDatabase();
        $i = 0;
        foreach ($products as $product) {
            if ($product[0]==$args['id']){
                unset($products[$i]);   
                $this->writeDatabase($products);
                echo "Product ", $args['id'], " was deleted", PHP_EOL;
                return;
            }
            $i++;
        }
        echo "Product does not exist", PHP_EOL;
    }
}

?>