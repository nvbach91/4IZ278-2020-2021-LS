<?php


class Address extends Model
{

    protected const TABLE_NAME = DB_PREFIX . "delivery_addresses";
    protected $attrMap = [
        "firstname",
        "lastname",
        "street",
        "city",
        "zip",
        "phone",
        "email",
        "users_id",
    ];

    public $firstname;
    public $lastname;
    public $street;
    public $city;
    public $zip;
    public $phone;
    public $email;
    public $users_id;

    public function __construct($id)
    {
        parent::__construct($id);
    }

}