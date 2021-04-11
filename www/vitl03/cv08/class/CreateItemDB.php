<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class CreateItemDB extends Database
{

    public function fetchAll()
    {

        $new_item = $_POST;
        $isSubmitted = !empty($_POST);
        $success = false;

        $errors = [];
        if (!empty($new_item)) {
            if (!is_numeric($new_item['price'])) {
                array_push($errors, "Price must be a number");
            }

            foreach ($new_item as $key => $value) {
                if (empty($value)) {
                    array_push($errors, "$key is empty");
                }
            }
        }

        if ($isSubmitted and empty($errors)) {
            // insert into database
            $statement = $this->pdo->prepare("
                        INSERT INTO `products`(`name`, `price`, `img`) VALUES 
                         (
                          ? , ? ,?
                         )                                           
                         ");
            $statement->execute(array($new_item['name'], $new_item['price'], $new_item['img']));
            $success = true;
        }
        return $success;
    }

    public function getErrors(){
        $new_item = $_POST;
        $errors = [];
        if (!empty($new_item)) {
            if (!is_numeric($new_item['price'])) {
                array_push($errors, "Price must be a number");
            }

            foreach ($new_item as $key => $value) {
                if (empty($value)) {
                    array_push($errors, "$key is empty");

                }
            }
        }
        return $errors;
    }
    public function create($args)
    {
        // create
    }
    public function update($args)
    {
        // update specified product  
    }
    public function delete($args)
    {
        // delete specified product
    }
}

?> 