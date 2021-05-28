<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class ProductsDB extends Database
{

    protected $tableName = 'products';
    public function fetchAll(){
        // fetch all
    }
    public function fetchAllPagination($nItemsPerPagination,$offset)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE 1 LIMIT ? OFFSET ?;');
        $statement->execute([$nItemsPerPagination,$offset]);

        return $statement->fetchAll();
    }

    public function fetchByProd($id)
    {

        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE product_id=?');
        $statement->execute(([$id]));
        return $statement->fetch();
    }
    public function fetchById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE product_id=?');
        $statement->execute([$id]);
        return $statement->fetch();
    }



    public function fetchByArray($array)
    {
        $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE product_id IN (' . $array . ')');
        $statement->execute(array_keys($products_in_cart));
        return $statement->fetchAll();
    }
    public function fetchColumn($value, $id)
    {
        $statement = $this->pdo->prepare('SELECT ' . $value . ' FROM ' . $this->tableName . ' WHERE product_id =?');
        $statement->execute([$id]);
        return $statement->fetchColumn();
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

                if ($key == 'name' || $key == 'price') {
                    if (empty($value)) {
                        array_push($errors, "$key is empty");
                    }
                }
            }
        }



        if ($isSubmitted and empty($errors)) {
            // insert into database
            $statement = $this->pdo->prepare("
                        INSERT INTO `products`(`name`, `price`, `discount`, `desc` ) VALUES 
                         (
                          ? , ? , ? , ?
                         )                                           
                         ");

            if (empty($new_item['discount'])) {
                $new_item['discount'] = 0;
            }
            $statement->execute(array($new_item['name'], $new_item['price'], $new_item['discount'], $new_item['description']));
            $success = true;
        }
        return $success;
    }
    public function update()
    {
        $statement = $this->pdo->prepare('UPDATE ' . $this->tableName . ' SET `name`= :name, `price` =:price,`discount`=:discount,`desc`=:desc,`last_updated_at`=now() WHERE `product_id`=:product_id');
        $statement->execute([
            'product_id' => htmlspecialchars($_POST['product_id']),
            'name' => htmlspecialchars($_POST['name']),
            'price' => htmlspecialchars($_POST['price']),
            'discount' => htmlspecialchars($_POST['discount']),
            'desc' => htmlspecialchars($_POST['desc'])
        ]);
    }

    public function deleteProduct($id)
    {
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
        $statement->execute(array(htmlspecialchars($_POST['product_id'])));
        return $statement->fetch();
    }
    public function getErrors()
    {
        $new_item = $_POST;
        $errors = [];
        if (!empty($new_item)) {
            if (!is_numeric($new_item['price'])) {
                array_push($errors, "Price must be a number");
            }

            foreach ($new_item as $key => $value) {

                if ($key == 'name' || $key == 'price') {
                    if (empty($value)) {
                        array_push($errors, "$key is empty");
                    }
                }
            }
        }


        return $errors;
    }

    public function getSumOfProducts()
    {
        $ids = @$_SESSION['cart'];
        if (is_array($ids) && count($ids)) {

            $question_marks = str_repeat('?,', count($ids) - 1) . '?';

            $products_sum = $this->pdo->prepare('SELECT SUM(price) FROM ' . $this->tableName . ' WHERE product_id IN ($question_marks)');

            $products_sum->execute(array_values($ids));
            return $products_sum->fetchColumn();
        }
    }
    public function showProductInCat()
    {

        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' JOIN product_category ON products.product_id=product_category.product_id WHERE product_category.category_id=?');
        $statement->execute(array(htmlspecialchars($_GET['category'])));
        return $statement->fetchAll();
    }

    public function searchProduct($search)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE name LIKE "%' . $search . '%" OR "desc" LIKE "%' . $search . '%"');
        $statement->execute();
        return $statement->fetchAll();
    }
}

?> 