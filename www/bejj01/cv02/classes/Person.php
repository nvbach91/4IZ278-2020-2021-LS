<?php
require './utils.php';

class Person {

    public function __construct(
        $firstName, $lastName, $logo, $title, 
        $company, $phone, $email, $website, $birthDate, $available,
        $street, $orientationNumber, $propertyNumber, $city
    ){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->logo = $logo;
        $this->title = $title;
        $this->company = $company;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->birthDate = $birthDate;
        $this->available = $available;
        $this->street = $street;
        $this->propertyNumber = $propertyNumber;
        $this->orientationNumber = $orientationNumber;
        $this->city = $city;
        $this->age = $this->getAge($birthDate);
    }

    public function getAge() {
        return calculateAge($this->birthDate);
    }

    public function getAddress() {
        return createWholeAddress($this->street, $this->propertyNumber, $this->orientationNumber, $this->city);
    }

    public function getFullName() {
        return "$this->firstName $this->lastName";
    }

    public function isAvailableForOffers() {
        return $this->available ? 'Available for contracts' : 'Not available for contracts';
    }
}

?>