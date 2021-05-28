<?php
/** @noinspection ALL */
require("./model/User.php");
require("./model/Permission.php");
require("./model/Order.php");
require("./model/Category.php");
require("./model/Product.php");
require("./model/Checkout.php");


class Dao
{
    private $conn;

    /**
     * Dao constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param User $user
     */
    public function createUser(User $user)
    {
        $username = $user->getUsername();
        $password = $user->getPassword();
        $surname = $user->getSurname();
        $lastname = $user->getLastname();
        $permissionId = $user->getPermissionid();

        $statement = $this->conn->prepare("INSERT INTO users (username, password, surname, lastname, permissionId) VALUES (?, ?, ?, ?, ?)");
        $statement->bindParam(1,$username,PDO::PARAM_STR);
        $statement->bindParam(2,$password,PDO::PARAM_STR);
        $statement->bindParam(3,$surname,PDO::PARAM_STR);
        $statement->bindParam(4,$lastname,PDO::PARAM_STR);
        $statement->bindParam(5,$permissionId,PDO::PARAM_INT);
        return (bool)$statement->execute();
    }

    /**
     * @param mixed $user
     */
    public function getUserByUsername($user)
    {
        $statement = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $statement->bindParam(1, $user, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function fetchUsers()
    {
        $statement = $this->conn->prepare("SELECT * FROM users");
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * @param $user
     * @return User
     */

    public function getUser($user)
    {
        return new User($user->userId, $user->username,$user->password,$user->surname,$user->lastname,$user->permissionId);
    }

    /**
     * @param User $user
     */
    public function saveUser(User $user)
    {
        $id = $user->getId();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $surname = $user->getSurname();
        $lastname = $user->getLastname();
        $permissionId = $user->getPermissionid();

        $statement = $this->conn->prepare("UPDATE users SET username = ?, password = ?, surname = ?, lastname = ?, permissionId = ? WHERE userId = ?");

        $statement->bindParam(1,$username,PDO::PARAM_STR);
        $statement->bindParam(2,$password,PDO::PARAM_STR);
        $statement->bindParam(3,$surname,PDO::PARAM_STR);
        $statement->bindParam(4,$lastname,PDO::PARAM_STR);
        $statement->bindParam(5,$permissionId,PDO::PARAM_INT);
        $statement->bindParam(6,$id, PDO::PARAM_INT);

        return (bool)$statement->execute();

    }

    /**
     * @param User $user
     */
    public function updateSession(User $user)
    {
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['permission'] = $user->getPermissionid();
        $_SESSION['user'] = serialize($user);
    }

    /**
     * @return array
     */
    public function createPermissions()
    {
        $permissions = [];


        $statement = $this->conn->prepare("SELECT * FROM permission");
        $statement->execute();
        $result = $statement->fetchAll();

        foreach ($result as $permission)
            array_push($permissions, new Permission($permission["permissionId"],$permission["name"]));

        return $permissions;
    }

    /**
     * @return array
     */
    public function fetchCategories()
    {
        $categories = [];
        $statement = $this->conn->prepare("SELECT * FROM categories");
        $statement->execute();
        $result = $statement->fetchAll();

        foreach ($result as $category)
            array_push($categories, new Category($category["categoryId"],$category["name"], $category["description"],$category["img"]));

        return $categories;

    }

    public function getCategoryById($id)
    {
        $statement = $this->conn->prepare("SELECT * FROM categories WHERE categoryId = ?");
        $statement->bindParam(1, $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);

        return new Category($result->categoryId, $result->name, $result->description, $result->img);
    }

    /**
     * @param Category $category
     * @return bool
     */
    public function insertCategory(Category $category)
    {
        $name = $category->getName();
        $description = $category->getDescription();
        $img = $category->getImg();

        $statement = $this->conn->prepare("INSERT INTO categories (name, description) VALUES (?, ?, ?)");
        $statement->bindParam(1,$name,PDO::PARAM_STR);
        $statement->bindParam(2,$description,PDO::PARAM_STR);
        $statement->bindParam(3,$img, PDO::PARAM_STR);

        return (bool)$statement->execute();
    }

    public function deleteCategory(Category $category)
    {
        $id = $category->getCategoryId();

        $statement = $this->conn->prepare("DELETE FROM categories WHERE categoryId = ?");
        $statement->bindParam(1, $id, PDO::PARAM_INT);

        return (bool)$statement->execute();
    }

    public function insertProduct(Product $product)
    {
        $name = $product->getTitle();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $disc = $product->getDiscount();
        $category = $product->getCategory();
        $img = $product->getImg();

        $statement = $this->conn->prepare("INSERT INTO game (title, price, category, description, discount, img) VALUES (?, ?, ?, ?, ?, ?)");
        $statement->bindParam(1,$name,PDO::PARAM_STR);
        $statement->bindParam(2,$price,PDO::PARAM_STR);
        $statement->bindParam(3,$category,PDO::PARAM_INT);
        $statement->bindParam(4,$description,PDO::PARAM_STR);
        $statement->bindParam(5,$disc,PDO::PARAM_INT);
        $statement->bindParam(6,$img,PDO::PARAM_STR);

        return (bool)$statement->execute();
    }

    public function insertCheckout(Checkout $checkout)
    {
        $gameId = $checkout->getGameId();
        $userId = $checkout->getUserId();
        $count = $checkout->getCount();

        $statement = $this->conn->prepare("INSERT INTO checkout (gameId, userId, count) VALUES (?, ?, ?)");
        $statement->bindParam(1,$gameId,PDO::PARAM_INT);
        $statement->bindParam(2,$userId,PDO::PARAM_INT);
        $statement->bindParam(3,$count,PDO::PARAM_INT);
        return (bool)$statement->execute();
    }

    public function deleteProduct(Product $product)
    {
        $id = $product->getGameId();

        $statement = $this->conn->prepare("DELETE FROM game WHERE gameId = ?");
        $statement->bindParam(1, $id, PDO::PARAM_INT);

        return (bool)$statement->execute();
    }

    public function deleteCheckout(Checkout $checkout)
    {
        $id = $checkout->getUserId();

        $statement = $this->conn->prepare("DELETE FROM checkout WHERE userId = ?");
        $statement->bindParam(1, $id, PDO::PARAM_INT);

        return (bool)$statement->execute();
    }

    public function updateCheckout(Checkout $checkout, $value)
    {
        $statement = $this->conn->prepare("UPDATE checkout SET count = ? WHERE checkoutId = ?");
        if($value == "up")
        {
            $count = $checkout->getCount() + 1;
            $statement->bindParam(1,$count,PDO::PARAM_INT);
        }
        elseif($value == "down")
        {
            $count = $checkout->getCount() - 1;
            $statement->bindParam(1,$count,PDO::PARAM_INT);
        }
        $id = $checkout->getCheckoutId();
        $statement->bindParam(2,$id,PDO::PARAM_INT);

        $statement->execute();
    }

    public function fetchCheckoutById($id)
    {
        $statement = $this->conn->prepare("SELECT * FROM checkout WHERE checkoutId = ?");
        $statement->bindParam(1, $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);

        return new Checkout($result->checkoutId,$result->gameId,$result->userId,$result->count);
    }

    public function fetchCheckoutByUserId($id)
    {
        $checkouts = [];
        $statement = $this->conn->prepare("SELECT * FROM checkout");
        $statement->execute();
        $result = $statement->fetchAll();

        foreach ($result as $checkout)
            array_push($checkouts, new Checkout($checkout['checkoutId'],$checkout['gameId'],$checkout['userId'],$checkout['count']));

        return $checkouts;
    }

    public function fetchProduct()
    {
        $products = [];
        $statement = $this->conn->prepare("SELECT * FROM game");
        $statement->execute();
        $result = $statement->fetchAll();

        foreach ($result as $product)
            array_push($products, new Product($product["gameId"],$product["title"], $product["price"],$product["category"],$product["description"],$product["discount"],$product["img"]));

        return $products;

    }

    public function fetchProductById($id)
    {
        $statement = $this->conn->prepare("SELECT * FROM game WHERE gameId = ?");
        $statement->bindParam(1,$id,PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);

        return new Product($result->gameId,$result->title,$result->price,$result->category,$result->description,$result->discount,$result->img);


    }

    public function fetchProductByQuery($q)
    {
        $products = [];
        $statement = $this->conn->prepare("SELECT * FROM game WHERE title LIKE ?");
        $statement->bindParam(1,$q,PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();

        foreach ($result as $product)
            array_push($products, new Product($product["gameId"],$product["title"], $product["price"],$product["category"],$product["description"],$product["discount"],$product["img"]));

        return $products;

    }

    public function fetchProductByCategory($categoryId)
    {
        $products = [];
        $statement = $this->conn->prepare("SELECT * FROM game WHERE category = ?");
        $statement->bindParam(1, $categoryId, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();

        foreach ($result as $product)
            array_push($products, new Product($product["gameId"],$product["title"], $product["price"],$product["category"],$product["description"],$product["discount"],$product["img"]));

        return $products;

    }


}
