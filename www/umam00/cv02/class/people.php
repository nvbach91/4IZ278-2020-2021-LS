<?php

class Person{
        
    public function __construct($avatar, $firstName, $lastName, $title, $company, $phone, $email, $website, $available,$street,$propertyNumber,$orientationNumber, $city)
    {
        $this->avatar = $avatar;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->title = $title;
        $this->company = $company;
        $this->phone = $phone;
        $this->website = $website;
        $this->available = $available;
        $this->street = $street;
        $this->propertyNumber = $propertyNumber;
        $this->orientationNumber = $orientationNumber;
        $this->city = $city;
        
    }
}
?>