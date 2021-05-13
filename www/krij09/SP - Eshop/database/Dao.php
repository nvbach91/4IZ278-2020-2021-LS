<?php
require("./model/User.php");
require("./model/Permission.php");
require("./model/Order.php");


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

}
