<?php
class Person
{
    public function __construct($name, $street, $number, $city, $phone, $mail, $birthDay, $birthMonth, $birthYear, $company, $web, $isAvailable, $logoPath)
    {
        $this->name = $name;
        $this->street = $street;
        $this->number = $number;
        $this->city = $city;
        $this->phone = $phone;
        $this->mail = $mail;
        $this->birthDay = $birthDay;
        $this->birthMonth = $birthMonth;
        $this->birthYear = $birthYear;
        $this->company = $company;
        $this->web = $web;
        $this->isAvailable = $isAvailable;
        $this->logoPath = $logoPath;
    }
    public function getAge(){
        $countedAge = 2021 - $this->birthYear;
        return $countedAge;
    }
    public function getBirthDateFormatted(){
        $birthDate = "$this->birthDay. $this->birthMonth. $this->birthYear";
        return $birthDate;
    }
    public function concatenateAddress(){
        $concatenatedAddress = "$this->street, $this->number, $this->city";
        return $concatenatedAddress;
    }
}
