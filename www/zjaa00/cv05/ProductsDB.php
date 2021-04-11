<?php
class ProductsDB extends Database {

  public function create($args) {
    $products = $this->fetchDB();
    $product['name'] = $args['name'];
    $product['price'] = $args['price'];
    array_push($products, $product);
    $this->rewriteDB($products);
    
    echo 'Product ', $args['name'], ' (' . (sizeof($products) - 1) . ')', ' price: ', $args['price'], ' was created', PHP_EOL; 
  }
  
  public function fetch($id) {
    $products = $this->fetchDB();
    if (isset($products[$id])) {
      echo 'Product ', $id,' was fetched', PHP_EOL;
      echo 'Name ', $products[$id][0], ' Price: ', $products[$id][1], PHP_EOL;
    } else {
      echo "Non-existing product", PHP_EOL;
    }
  }

  public function save($id, $args) {
    $products = $this->fetchDB();
    if (isset($products[$id])) {
      $products[$id] = $args;
      $this->rewriteDB($products);  

      echo 'Product ', $id,' was saved', PHP_EOL;
      echo 'Name ', $products[$id]['name'], ' Price: ', $products[$id]['price'], PHP_EOL;
    } else {
      echo "Non-existing product", PHP_EOL;
    }
  }
  
  public function delete($id) {
    $products = $this->fetchDB();
    if (isset($products[$id])) {
      $name = $products[$id][0];
      $price = $products[$id][1];
      unset($products[$id]);
      $products = array_values($products);
      $this->rewriteDB($products);
      echo 'Product ', $id,' was deleted', PHP_EOL;
      echo 'Name ', $name, ' Price: ', $price, PHP_EOL;
    } else {
      echo "Non-existing product", PHP_EOL;
    }
  }

}

$products = new ProductsDB();
$products->clearData(); //resetuje databázu
$products->create(['name' => 'Broom of Harry', 'price' => 4500]);
$products->create(['name' => 'Wand of Albuss', 'price' => 7690]);
$products->fetch(1);
$products->save(0, ['name' => 'Paper', 'price' => 100]);
$products->delete(1);
echo PHP_EOL;