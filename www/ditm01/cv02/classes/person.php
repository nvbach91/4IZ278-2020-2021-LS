<?php require './utils.php' ?>
<?php
class Person {

    public function __construct($avatar, $lastname, $firstname, $secondname, $profession, $company, $street, $propertynumber, $orientationnumber, $city, $phone, $email, $web, $availability, $birthdate) {
        $this->avatar = $avatar;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->secondname = $secondname;
        $this->profession = $profession;
        $this->company = $company;
        $this->street = $street;
        $this->propertynumber = $propertynumber;
        $this->orientationnumber = $orientationnumber;
        $this->city = $city;
        $this->phone = $phone;
        $this->email = $email;
        $this->web = $web;
        $this->availability = $availability;
        $this->birthdate = $birthdate;
    }

    public function getFullName() {
        return "$this->firstname $this->secondname $this->lastname"; 
    }

    public function getAddress() {
        return "$this->street $this->propertynumber/$this->orientationnumber, $this->city"; 
    }

    public function getAge() {
        return calculateAge($this->birthdate) . " years"; 
    }
}