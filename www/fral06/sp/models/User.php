<?php


class User extends Model
{
    private $id;
    private $userName;
    private $email;
    private $role;

    /**
     * User constructor.
     * @param $id
     * @param $userName
     * @param $email
     * @param $role
     */

    /**
     * User constructor.
     * @param $id
     * @param $userName
     * @param $email
     * @param $role
     */
    public function __construct($id, $userName, $email, $role)
    {
        $this->id = $id;
        $this->userName = $userName;
        $this->email = $email;
        $this->role = $role;
    }

}