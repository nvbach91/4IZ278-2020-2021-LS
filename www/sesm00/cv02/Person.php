<?php

class Person
{
    function __construct($logo, $name, $surname, $position, $company, $phone, $mail, $web, $street, $propertyNum, $orientNum, $city, $birthDate) {
        $this->logo = $logo;
        $this->name = $name;
        $this->surname = $surname;
        $this->position = $position;
        $this->company = $company;
        $this->phone = $phone;
        $this->mail = $mail;
        $this->web = $web;
        $this->street = $street;
        $this->propertyNum = $propertyNum;
        $this->orientNum = $orientNum;
        $this->city = $city;
        $this->birthDate = $birthDate;
    }

    public function getBuddyAdress() {
        return $this->street . ' ' . $this->propertyNum . '/' . $this->orientNum . ', ' . $this->city;
    }

    public function getFullName() {
        return $this->name . ' ' . $this->surname;
    }

    public function getAge() {
        return calculateAge($this->birthDate);
    }

}