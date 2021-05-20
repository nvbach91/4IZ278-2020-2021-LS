<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class UsersDB extends Database
{
    protected $tableName = 'user';
    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchUserbyFbId($id)
    {
        $sql = "SELECT * FROM user WHERE user_fb_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll();
    }
    public function createUser($fbId, $name, $email)
    {
        $sql = "INSERT INTO user (user_fb_id, user_name, user_email) VALUES (:fbId,:name,:email);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'fbId' => $fbId,
            'name' => $name,
            'email' => $email
        ]);
    }
    public function updateUser($email, $userName, $phoneNumber, $street, $descNumber, $city, $zip, $state, $fbId)
    {
        $sql = "UPDATE user SET user_email = :email, user_name = :userName, user_phone_number = :phoneNumber, user_street = :street,
        user_descriptive_number = :descNumber, user_city= :city, user_zip_code= :zip, user_state = :userState WHERE user_fb_id= :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'userName' => $userName,
            'phoneNumber' => $phoneNumber,
            'street' => $street,
            'descNumber' => $descNumber,
            'city' => $city,
            'zip' => $zip,
            'userState' => $state,
            'id' => $fbId
        ]);
    }
}

?>