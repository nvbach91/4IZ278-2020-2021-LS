<?php 

class Person {

    public function __construct($avatar, $firstName, $lastName, $age, $job, $company, $email, $phone, $webPage, $street, $entryNumber, $zip, $city){
        $this->avatar = $avatar;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->job = $job;
        $this->company = $company;
        $this->email = $email;
        $this->phone = $phone;
        $this->webPage = $webPage;
        $this->street = $street;
        $this->entryNumber = $entryNumber;
        $this->zip = $zip;
        $this->city = $city;
    }

    public function getAddress() {
        return "$this->street, $this->entryNumber / $this->city, $this->zip $this->city";
    }

}

?>