<?php
class Person {
    public function __construct($avatar,$firstName, $lastName, $title, $company, $phone, $email, $street, $propNumber, $orientationNumber, $city, $birthDate) {
        $this->avatar = $avatar;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->title = $title;
        $this->company = $company;
        $this->phone = $phone;
        $this->email = $email;
        $this->street = $street;
        $this->propNumber = $propNumber;
        $this->orientationNumber = $orientationNumber;
        $this->city = $city;
        $this->birthDate = $birthDate;
    }
}
?>