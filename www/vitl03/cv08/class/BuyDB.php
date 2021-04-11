<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class BuyDB extends Database
{

    public function fetchAll()
    {

        session_start();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $sql = "SELECT * FROM products WHERE product_id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $_GET['id']]);
        $products = $statement->fetch();
        if (!$products){
            exit("Unable to find products!");
        }
        
        $_SESSION['cart'][] = $products["product_id"];
        header('Location: cart.php');
        exit();
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