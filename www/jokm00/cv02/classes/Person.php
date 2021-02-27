<?php require "./utils.php"?>
<?php class Person{

public function __construct($logo, $firstName, $lastName, $birthDate, $title, $company, $phone, $email, $website, $street, $streetNumber, $city, $zipCode){
    $this->logo = $logo;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->title = $title;
    $this->company = $company;
    $this->phone = $phone;
    $this->email = $email;
    $this->website = $website;
    $this->street = $street;
    $this->streetNumber = $streetNumber;
    $this->city = $city;
    $this->zipCode = $zipCode; 
    $this->birthDate = $birthDate;
}

function getAdress(){
    return "$this->street $this->streetNumber, $this->city $this->zipCode";
}

function getFullName(){
    return "$this->firstName $this->lastName";
}

function getAge(){
    return calculateAge($this->birthDate);
}
}
?>