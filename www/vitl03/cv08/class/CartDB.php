<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class CartDB extends Database
{

    public function fetchAll()
    {

        session_start();
        $ids = @$_SESSION['cart'];
        if (is_array($ids) && count($ids)) {

            $question_marks = str_repeat('?,', count($ids) - 1) . '?';

            $statement = $this->pdo->prepare("SELECT * FROM products WHERE product_id IN ($question_marks)");

            $statement->execute(array_values($ids));
            return $statement->fetchAll();
      
        }
    }

    public function getSumOfProducts()
    {
        $ids = @$_SESSION['cart'];
        if (is_array($ids) && count($ids)) {

            $question_marks = str_repeat('?,', count($ids) - 1) . '?';

        $products_sum = $this->pdo->prepare("SELECT SUM(price) FROM products WHERE product_id IN ($question_marks)");
       
        $products_sum->execute(array_values($ids));
        return $products_sum->fetchColumn();
        }
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