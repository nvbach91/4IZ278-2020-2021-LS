<?php

class Person {

    public function __construct($logo, $surname,$name,$birthdayDate,$occupation,
                        $company,$street,$propertyNumber, $orientationNumber, $city, $phone,$email,$website,$available)
    {
        $this->logo = $logo;
        $this->surname = $surname;
        $this->name = $name;
        $this->birthdayDate = $birthdayDate;
        $this->occupation = $occupation;
        $this->company = $company;
        $this->street = $street;
        $this->propertyNumber = $propertyNumber;
        $this->orientationNumber = $orientationNumber;
        $this->city = $city;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->available = $available;
    }

    public function getFullName() {
        return $this->name." ".$this->surname;
    }

    public function getAge() {
        $currDate = new DateTime();
        $age = $currDate->diff($this->birthdayDate)->y;
        return $age;
    }

    public function getAddress() {
        $address = $this->street." ".$this->propertyNumber."/".$this->orientationNumber.", ".$this->city;
        return $address;
    }
}