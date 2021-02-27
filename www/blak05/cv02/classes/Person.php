<?php
    class Person{
        public function __construct($avatar, $firstName, $lastName, $birthDay, $title, $company, $phone, $email, $website, $available, $street, $propertyNumber, $orientationNumber, $city){
            $this -> avatar = $avatar; 
            $this -> firstName = $firstName; 
            $this -> lastName = $lastName; 
            $this -> birthDay = $birthDay;
            $this -> title = $title; 
            $this -> company = $company; 
            $this -> phone = $phone;
            $this -> email = $email; 
            $this -> website = $website; 
            $this -> available = $available; 
            $this -> street = $street; 
            $this -> propertyNumber = $propertyNumber; 
            $this -> orientationNumber = $orientationNumber; 
            $this -> city = $city;
        }
        public function getAddress() {
            return "$this->street $this->propertyNumber / $this->orientationNumber, $this->city";
        }
        public function getFullName() {
            return "$this->firstName $this->lastName";
        }
        public function getAge() {
            return ageCount($this->birthDay);
        }
    }
?>