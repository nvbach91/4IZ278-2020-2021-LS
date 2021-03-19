<?php


namespace cv05\src\domain;


class User
{
    public $username;

    public $email;

    public $password;

    public function __construct(string $username, string $email, string $password) {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }
}