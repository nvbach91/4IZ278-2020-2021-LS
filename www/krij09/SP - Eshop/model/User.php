<?php

//require('./model/Permission.php');

class User
{
    private $id;
    private $username;
    private $password;
    private $surname;
    private $lastname;
    private $permissionid;



    /**
     * User constructor.
     * @param $id
     * @param $username
     * @param $password
     * @param $surname
     * @param $lastname
     * @param $permissionid
     */
    public function __construct($id, $username, $password, $surname, $lastname, $permissionid)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->surname = $surname;
        $this->lastname = $lastname;
        $this->permissionid = $permissionid;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getPermissionid()
    {
        return $this->permissionid;
    }

    /**
     * @param mixed $permissionid
     */
    public function setPermissionid($permissionid): void
    {
        $this->permissionid = $permissionid;
    }

    /**
     * @return Permission
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * @param Permission $permission
     */
    public function setPermission(Permission $permission)
    {
        $this->permission = $permission;
    }




}