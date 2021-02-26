<?php

require __DIR__ . "/utils.php";

final class Person {
    /**
     * @var string
     */
    public $avatar;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $surname;

    /**
     * @var DateTime
     */
    public $birth;

    /**
     * @var string
     */
    public $job;

    /**
     * @var string
     */
    public $company;

    /**
     * @var string
     */
    public $street;

    /**
     * @var string
     */
    public $streetNumber;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $website;

    /**
     * @var bool
     */
    public $availableForHire;

    public function __construct($avatar, $name, $surname, $birth, $job, $company, $street, $streetNumber, $city, $phone, $email, $website, $availableForHire) {
        $this->avatar = $avatar;
        $this->name = $name;
        $this->surname = $surname;
        $this->birth = $birth;
        $this->job = $job;
        $this->company = $company;
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->city = $city;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->availableForHire = $availableForHire;
    }

    /**
     * @return string
     */
    public function getAddress() {
        return "$this->street $this->streetNumber, $this->city";
    }

    /**
     * @return string
     */
    public function getFullName() {
        return "$this->name $this->surname";
    }

    public function getAge() {
        return computeAgeFromDateOfBirth($this->birth);
    }
}