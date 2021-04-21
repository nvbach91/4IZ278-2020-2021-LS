<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class ProductsDB extends Database
{

    protected $tableName = 'products';
    public function fetchAll()
    {
        $offset = 0;

        if (!empty($_GET)) {
            $offset = $_GET['offset'];
        }
        $nItemsInDatabase = $this->pdo->query('SELECT COUNT(product_id) FROM ' . $this->tableName)->fetchColumn();
    

        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE 1 LIMIT ' . ITEMS_PER_PAGINATION . ' OFFSET ?;';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $offset, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function fetchNumberOfProducts()
    {
        return $this->pdo->query('SELECT COUNT(product_id) FROM ' . $this->tableName)->fetchColumn();
    }
    public function create()
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
    public function update()
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE product_id=?');
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


            $statement = $this->pdo->prepare('UPDATE ' . $this->tableName . ' SET name=?, price=?, img=? WHERE product_id=?');
            $statement->execute(array($name, $price, $img, $id));

            header('Location: index.php');
        }
    }
    public function delete()
    {
        $id = @$_GET['id'];

        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE product_id=:id;';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);

        header('Location: index.php');
    }
    public function getClientInfo()
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE product_id=?');
        $statement->execute(array($_GET['id']));
        return $statement->fetch();
     
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
    public function buy(){
        
        session_start();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE product_id = :id';
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


    public function cart()
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
}

?> 