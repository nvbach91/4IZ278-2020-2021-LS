<?php
require_once "Order.php";
require_once "OrdersDB.php";
require_once "UsersDB.php";

class Profile
{
    private $ID;
    private $username;
    private $firstName;
    private $lastName;
    private $address;
    private $email;
    private $privileges;
    private $orders = [];
public function __construct(int $id){
    //basic
    $usersDB = new UsersDB();
    $profile = $usersDB -> getItem("ID", $id);
    $this -> username = $profile["username"];
    $this -> firstName = $profile["firstName"];
    $this -> lastName = $profile["lastName"];
    $this -> address = $profile["address"];
    $this -> email = $profile["email"];
    $this -> privileges = $profile["privileges"];
    $this -> ID = $profile["ID"];

    //orders
    $ordDB =new OrdersDB();
    $allOrders = $ordDB ->fetchAll();
    foreach ($allOrders as $item){
        if($item["fk_users_ID"] == $id){
            $order = new Order();
            $order ->gatherData($item["ID"]);
            $this -> orders[$item["ID"]] = $order;
        }
    }
}

    /**
     * @return mixed
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPrivileges()
    {
        return $this->privileges;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }
}