<?php
class Person
{
    public $image;
    public $name;
    public $address;
    public $mail;
    public $web;

    public function __construct($image, $name, $address, $mail, $web)
    {
        $this->image = $image;
        $this->name = $name;
        $this->address = $address;
        $this->mail = $mail;
        $this->web = $web;
    }
}

