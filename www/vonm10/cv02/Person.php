<?php require './utils.php'; ?>
<?php
class Person 
{
    public function __construct($firstName, $lastName, $title, $company, $phone, $email, $website, $available, $street, $propertyNumber, $orientationNumber, $city, $dateOfBirth) 
    {
        $this -> firstName = $firstName;
        $this -> lastName = $lastName;
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
        $this -> dateOfBirth = $dateOfBirth;
    }   

    public function getAge()
    {
        $age = deductAge($this -> dateOfBirth);
        return $age;
    }

    public function getAddress()
    {
        $street = $this->street;
        $propertyNumber = $this->propertyNumber;
        $orientationNumber = $this->orientationNumber;
        $city = $this->city;
        $address = $street . " " . $propertyNumber . "/" . $orientationNumber . " " . $city;
        return $address;
    }

    public function getFullName()
    {
        return '$this->firstName $this->lastName';
    }
}
?>