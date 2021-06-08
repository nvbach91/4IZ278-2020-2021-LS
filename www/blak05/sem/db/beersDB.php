<?php require_once __DIR__ . '/db.php'; ?>
<?php

class BeersDB extends Database
{
    protected $tableName = 'Products';
    public function fetchAll()
    {
        $sql = 'SELECT p.*, c.cat_name FROM ' . $this->tableName . ' p, Categories c WHERE p.id_category=c.id_category AND p.id_category<>6';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchAllBrew()
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE id_category=6';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create($args)
    {
        $sql = "INSERT INTO " . $this->tableName . " (name, brand, shortbrand, description, price, stock, id_category, image) VALUES (?,?,?,?,?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($args); 
    }
    public function fetchCart()
    {
        $sql= "SELECT * FROM " . $this->tableName . ' WHERE id_product IN (' . implode(",",$_SESSION['cart']) .')';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchCategories($args)
    {
        $sql= "SELECT p.*, c.cat_name FROM " . $this->tableName . ' p, Categories c WHERE p.id_category=c.id_category AND p.id_category='. $args ;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchBrand($args)
    {
        $sql= "SELECT p.*, c.cat_name FROM " . $this->tableName . ' p, Categories c WHERE p.id_category=c.id_category AND p.shortbrand="'. $args . '" ';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchBeer($args)
    {
        $sql= "SELECT p.*, c.cat_name FROM " . $this->tableName . ' p, Categories c WHERE p.id_category=c.id_category AND p.id_product="'. $args . '"';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetch();
    }
    public function fetchBrew($args)
    {
        $sql= "SELECT * FROM " . $this->tableName . ' WHERE id_product="'. $args . '" ';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetch();
    }
    public function update($args)
    {
       $sql = "UPDATE " . $this->tableName . " SET name=?, brand=?, shortbrand=?, description=?, price=?, stock=?, id_category=?, image=? WHERE id_product=?";
       $statement= $this->pdo->prepare($sql);
       $statement->execute($args);
    }
    public function delete($args)
    {
        $sql = "DELETE FROM " . $this->tableName . " WHERE id_product = $args[0]";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(); 
    }
}

?>