<?php


class Person
{
    private $name;
    private $surname;
    private $gender;
    private $myJob;
    private $company;
    private $department;
    private $address;
    private $city;
    private $tel ;
    private $mail;
    private $birthDay;

    public function __construct(string $name, string $surname, string $gender, string $myJob, string $company, string $department, string $address, string $city, string $tel, string $mail, DateTime $birthDay )
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->gender = $gender;
        $this->myJob = $myJob;
        $this->company = $company;
        $this->department = $department;
        $this->address = $address;
        $this->city = $city;
        $this->tel = $tel;
        $this->mail = $mail;
        $this->birthDay = $birthDay;
    }

    public function getFullName(): string
    {
        return "$this->name $this->surname";
    }

    public function getMyJob(): string
    {
        return $this->myJob;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getTel(): string
    {
        return $this->tel;
    }

    public function getMail(): string
    {
        return "$this->mail@gmail.com";
    }

    public function getWeb(): string
    {
        return "https://styling.$this->mail.cz";
    }

    public function getAge(): int
    {
        return date_diff($this->birthDay, date_create('now'))->y;
    }

    public function getAvailable(): string
    {
        return $this->gender == 'F' ? "dostupná k pracovním nabídkám" : "dostupný k pracovním nabídkám";
    }



}