<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class EditItemDB extends Database
{

    public function fetchAll()
    {
        $statement = $this->pdo->prepare("SELECT * FROM products WHERE product_id=?");
        $statement->execute(array($_GET['id']));
        $client = $statement->fetch();

        if (!$client) {
            die("Unable to find a client");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $id = $_GET['id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $img = $_POST['img'];


            $statement = $this->pdo->prepare("UPDATE products SET name=?, price=?, img=? WHERE product_id=?");
            $statement->execute(array($name, $price, $img, $id));

            header('Location: index.php');
        }
    }

    public function getClientInfo()
    {
        $statement = $this->pdo->prepare("SELECT * FROM products WHERE product_id=?");
        $statement->execute(array($_GET['id']));
        return $statement->fetch();
     
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