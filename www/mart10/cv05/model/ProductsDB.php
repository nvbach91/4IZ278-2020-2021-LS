<?php
class ProductsDB extends Database {
    public function create($args) { 
        $input =
        [
            'id' => $args['id'],
            'name' => $args['name'],
            'price' => $args['price']
        ];

        $file = file($this->dbPath.'products'.$this->dbExtension);
        $isExistingProduct = false;

        if(!empty($file)){
            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $product =
                    [
                        'id' => $fields[0]
                    ];

                if ($product['id'] === $input['id']) {
                    $isExistingProduct = true;
                    break;
                }
            }
        }

            if ($isExistingProduct) {
                echo "Product with this id already exists";
            } else {$record = implode($this->delimiter, $input) . "\r\n";
                file_put_contents($this->dbPath.'products'.$this->dbExtension, $record, FILE_APPEND);

                echo '<br>Product ', $args['name'], ' price: ', $args['price'], ' was created', PHP_EOL; }


    }
    public function fetch($args)  { 

        $productId = $args['id'];

        $output =
        [
            $name = '',
            $price = ''
        ];

        $file = file($this->dbPath.'products'.$this->dbExtension);
        $isExistingProduct = false;


            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $product =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'price' => $fields[2],
                    ];

                if ($product['id'] === $productId) {
                    $isExistingProduct = true;
                    $output['name'] = $product['name'];
                    $output['price'] = $product['price'];
                    break;
                }
            }

            if ($isExistingProduct) {
                echo "<br>" . $output['name']. ' '. $output['price'];
                echo "<br>". 'A product was fetched', PHP_EOL;
            } else {echo "<br>" . 'Product not found';
                echo "<br>". 'Product was not fetched', PHP_EOL;}

     }

    public function save($args)   
    { 
        $productId = $args['id'];
        $newName = $args['name'];
        $newPrice = $args['price'];

        $output =
        [
            $name = '',
            $price = ''
        ];

        $file = file($this->dbPath.'products'.$this->dbExtension);
        $isExistingProduct = false;


            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $product =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'price' => $fields[2],
                    ];

                if ($product['id'] === $productId) {
                    $product['name'] = $newName;
                    $product['price'] = $newPrice;
                    $output['name'] = $product['name'];
                    $output['price'] = $product['price'];
                    $isExistingProduct = true;
                    break;
                }
            }

            if ($isExistingProduct) {
                $this -> delete(['id' => $productId]);
                $this -> create(['id' => $productId, 'name' => $output['name'], 'price' => $output['price']]);
                echo "<br>" . $output['name']. ' '. $output['price'];
                echo "<br>". 'A product was updated', PHP_EOL;
            } else {echo "<br>" . 'Product not found';
                echo "<br>". 'Product was not updated', PHP_EOL;}

    }
    public function delete($args) 
    {
        $productId = $args['id'];
        $output =
        [
            $name = '',
            $price = ''
        ];

        $file = file($this->dbPath.'products'.$this->dbExtension);
        $isExistingProduct = false;


            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $product =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'price' => $fields[2],
                    ];

                if ($product['id'] === $productId) {
                    $output['name'] = $product['name'];
                    $output['price'] = $product['price'];
                    $isExistingProduct = true;
                    $replace = str_replace($record,'',$file);
                    file_put_contents($this->dbPath.'products'.$this->dbExtension,$replace);
                    break;
                }
            }

            if ($isExistingProduct) {
                echo "<br>" . $output['name']. ' '. $output['price'];
                echo '<br> A product was deleted', PHP_EOL;
            } else {echo "<br>" . 'Product not found';
                echo '<br> Product was not deleted', PHP_EOL; }


    }
}
?>
