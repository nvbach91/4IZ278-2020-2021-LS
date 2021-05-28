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
        $statement = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE id = ?');
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

    public function update($value, $key)
    {
        $statement = $this->pdo->prepare('UPDATE ' . $this->tableName . ' SET privilege=? WHERE id=?');
        $statement->execute(array($value, $key));
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


    public function updateInfo($email,$firstName,$lastName, $address, $city,$country,$zip,$phone){
        $statement = $this->pdo->prepare('UPDATE ' . $this->tableName . ' SET firstName=?, lastName=?, address=?,city=?,country=?,zip=?,phone=? WHERE email=?');
        $statement->execute([
            $firstName,
            $lastName,
            $address,
            $city,
            $country,
            $zip,
            $phone,
            $email
        ]);
    }


    public function insertUser($firstName,$lastName,$email)
    {
        $statement = $this->pdo->prepare('INSERT INTO ' . $this->tableName . '(firstName,lastName,email) VALUES (?,?,?)');
        $statement->execute([
            $firstName,
            $lastName,
            $email
            
        ]);
    }

}

?> 