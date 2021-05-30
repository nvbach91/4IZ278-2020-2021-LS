<?php require_once __DIR__ . '/db.php'; ?>
<?php

class UsersRepository extends Database
{
    protected $tableName = 'user';

    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function createUser($args)
    {
        $sql = 'INSERT INTO ' . $this->tableName . '(username, email, password, facebook_id) VALUES (:username, :email, :password, :facebook_id)';
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'username' => $args['username'],
            'email' => $args['email'],
            'password' => $args['password'],
            'facebook_id' => $args['facebook_id'] ? $args['facebook_id'] : null
        ]);
        $statement->fetchAll();
    }

    public function getUser($username)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE username = :username';
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'username' => $username
        ]);
        return $statement->fetchAll();
    }

    public function getUserByFacebookId($facebookId)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE facebook_id = :facebook_id';
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'facebook_id' => $facebookId
        ]);
        return $statement->fetchAll();
    }
}

?>