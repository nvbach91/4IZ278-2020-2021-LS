<?php 
class BusinessCard {
    public function __construct($title, $name, $surname, $city, $phoneNumber, $email)
    {
        $this->title = $title;
        $this->name = $name;
        $this->surname = $surname;
        $this->city = $city;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
    }
}

?>