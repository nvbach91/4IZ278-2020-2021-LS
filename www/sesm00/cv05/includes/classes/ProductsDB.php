<?php


class ProductsDB extends Database
{
    protected $file = "products";

    public function fetch($args)
    {
        $product = $this->readDatabase()[$args['id']];
        if (isset($product)) {
            echo "Product ", $args['id'], " was fetched", PHP_EOL;
            echo "Name: ", $product[0], " Price: ", $product[1], " ", $product[2], PHP_EOL;
        } else {
            echo "Product does not exist", PHP_EOL;
        }
    }

    public function create($args)
    {
        $products = $this->readDatabase();
        array_push($products, array($args['name'], $args['price'], $args['priceTag']));
        $this->writeDatabase($products);
        echo "Product with name ", $args['name'], " and price ", $args['price'], " ", $args['priceTag'], " was created", PHP_EOL;
    }

    public function update($args)
    {
        $products = $this->readDatabase();
        if (isset($products[$args['id']])) {
            $products[$args['id']] = array_values($args['product']);
            $this->writeDatabase($products);
            echo "Product ", $args['id'], " was updated", PHP_EOL;
        } else {
            echo "Product does not exist", PHP_EOL;
        }
    }

    public function delete($args)
    {
        $products = $this->readDatabase();
        if (isset($products[$args['id']])) {
            unset($products[$args['id']]);
            $this->writeDatabase($products);
            echo "Product with id ", $args['id'], " was deleted", PHP_EOL;
        } else {
            echo "Product does not exist", PHP_EOL;
        }
    }
}