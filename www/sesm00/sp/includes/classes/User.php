<?php


class User extends Model
{

    protected $tableName = DB_PREFIX . "users";
    protected $attrMap = [
        "firstname",
        "lastname",
        "email",
        "password",
        "phone",
    ];

    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $phone;

    public function __construct($id)
    {
        parent::__construct($id);
    }

}