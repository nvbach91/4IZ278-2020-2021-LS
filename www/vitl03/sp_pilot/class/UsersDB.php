<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class UsersDB extends Database
{
    protected $tableName = 'users';
    public function fetchAll()
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE user_id = ?');
        $statement->execute([$id]);
        // Fetch the product from the database and return the result as an Array
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchByEmail($email)
    {

        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE email=?');
        $statement->execute([$email]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function create()
    {
        // create
    }
    public function update($value, $key)
    {
        $statement = $this->pdo->prepare('UPDATE ' . $this->tableName . ' SET privillage=? WHERE id=?');
        $statement->execute(array($value, $key));
    }
    public function delete()
    {
        // delete category
    }

    public function fetchUserByEmail($email)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE email =? LIMIT 1');
        $statement->execute([
            $email
        ]);
        return @$statement->fetchAll()[0];
    }

    public function insert($email, $hashedPassword)
    {
        $statement = $this->pdo->prepare('INSERT INTO ' . $this->tableName . '(email, password) VALUES (?, ?)');
        $statement->execute([
            $email,
            $hashedPassword
        ]);
    }

    public function fetchUserById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE id = ? LIMIT 1');
        $statement->execute([
            $id
        ]);
        return $statement->fetchAll()[0];
    }
}

?> 