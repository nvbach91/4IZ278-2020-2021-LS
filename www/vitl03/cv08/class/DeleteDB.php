<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class DeleteDB extends Database
{

    public function fetchAll()
    {
        $id = @$_GET['id'];

        $sql = "DELETE FROM products WHERE product_id=:id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);

        header('Location: index.php');
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