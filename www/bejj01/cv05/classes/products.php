<?php

require_once  __DIR__ . '/database.php';

class ProductsDB extends AbstractDatabase {
    public function __construct($keys, $idIndex) {
        parent::__construct('/products', $keys, $idIndex);
    }

    public function create($args) {
        $keys = array_keys($args);
        if ( count($args) !== count($this->columns) && !empty(array_diff($keys, $this->columns)) ) {
            echo 'Product cannot be created. Wrong parameters entered.', nl2br("\n");
            return;
        }

        $products = $this->getAllData($this->idIndex, $this->columns);

        if (key_exists($args[$this->columns[$this->idIndex]], $products)) {
            $this->outputAlreadyExistingIdMessage('Product', $args);
            return;
        }

        $this->createRecord($args);

        echo 'New product was created with parameters: ', $this->outputProductData($args), nl2br("\n");
    }

    public function fetch($productCode) {
        $product = $this->getRecord($productCode, $this->idIndex, $this->columns);
        if ($product) {
            echo 'A product "', $product['code'] ,'" was fetched. Product\'s data: ', $this->outputProductData($product), nl2br("\n");
        }
        else {
            $this->outputNotFoundIdMessage('Fetch', 'Product', $productCode);
        }
        
    }

    public function update($productCode, $updatedValues) {
        $product = $this->getRecord($productCode);

        if ($product) {
            $updatedProduct = $this->getUpdatedRecord($product, $updatedValues);
            if (!$updatedProduct) {
                echo 'You are trying to update non-existent product columns data.', nl2br("\n");
            }
            else {
                echo 'Product data for product "', $product['code'], '" was updated. New data: ', $this->outputProductData($updatedProduct), nl2br("\n");
            }
        }
        else {
            $this->outputNotFoundIdMessage('Update', 'Product', $productCode);
        }
    }

    public function delete($productCode) {
        if ($this->removeRecord($productCode)) {
            echo 'A product with code: "', $productCode, '" was deleted', nl2br("\n");
        }
        else {
            $this->outputNotFoundIdMessage('Delete', 'Product', $productCode);
        }
    }

    private function outputProductData($product) {
        return '[ Code: ' .  $product['code'] . ', Name: ' . $product['name'] . ', Author: ' .  $product['author'] . ', Price: ' .  $product['price'] . ' ]';
    }
}

$products = new ProductsDB(['code', 'name', 'author', 'price'], 0);
// clear data files before, only for testing purpose
$products->clear();
$products->create(['code' => 'B001', 'name' => 'Interesting Book', 'author' => 'Famous McAuthor', 'price' => '100 USD']);
// could not create product with same id
$products->create(['code' => 'B001', 'name' => 'Interesting Book', 'author' => 'NonFamous McAuthor', 'price' => '200 USD']);
$products->create(['code' => 'B002', 'name' => 'Not Interesting Book', 'author' => 'Non Famous McAuthor', 'price' => '2 USD']);
$products->create(['code' => 'M001', 'name' => 'Interesting Movie', 'author' => 'Famous McDirector', 'price' => '50 USD']);
$products->create(['code' => 'M002', 'name' => 'Not Interesting Movie', 'author' => 'Non Famous McDirector', 'price' => '20 CZK']);
// will fetch product
$products->fetch('M002');
// cannot delete non existent product
$products->delete('nonsenseCode');
// should delete
$products->delete('B001');
// product was deleted -> fetch should fail
$products->fetch('B001');
// should update values
$products->update('B002', ['name' => 'New Book Name', 'author' => 'Jack O\'Famous', 'price' => '150 EUR']);
// wrong column id -> fail
$products->update('M001', ['coconut' => '200']);

?>