<?php

class Person
{
    private $name;
    private $surName;
    private $dateBirth;
    private $phoneNumber;
    private $email;
    private $available;
    private $position;

    private $logo;
    private $companyName;
    private $city;
    private $street;
    private $propertyNO;
    private $orientationNO;
    private $companyWeb;

    /**
     * Person constructor.
     * @param $name
     * @param $surName
     * @param $dateBirth
     * @param $phoneNumber
     * @param $email
     * @param $available
     * @param $position
     * @param $logo
     * @param $companyName
     * @param $city
     * @param $street
     * @param $propertyNO
     * @param $orientationNO
     * @param $companyWeb
     */
    public function __construct($name, $surName, $dateBirth, $phoneNumber, $email, $available, $position, $logo, $companyName, $city, $street, $propertyNO, $orientationNO, $companyWeb)
    {
        $this->name = $name;
        $this->surName = $surName;
        $this->dateBirth = $dateBirth;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->available = $available;
        $this->position = $position;
        $this->logo = $logo;
        $this->companyName = $companyName;
        $this->city = $city;
        $this->street = $street;
        $this->propertyNO = $propertyNO;
        $this->orientationNO = $orientationNO;
        $this->companyWeb = $companyWeb;
    }

    public function getAddress(): string
    {
        return "$this->street $this->propertyNO/$this->orientationNO, $this->city";

    }

    public function getAge()
    {
        $bday = new DateTime($this->dateBirth); // Your date of birth
        $today = new Datetime(date('m.d.y'));
        $age = $today->diff($bday);

        return $age->y;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSurName()
    {
        return $this->surName;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getAvailable(): string
    {
        return $this->available ? 'Available for contracts': 'Not available for contracts';
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @return mixed
     */
    public function getCompanyWeb()
    {
        return $this->companyWeb;
    }




}