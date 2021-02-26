<?php
  class Person {
    public function __construct(
      $logo,
      $firstName,
      $lastName,
      $role,
      $company,
      $phone,
      $email,
      $website,
      $street,
      $propertyNumber,
      $orientationNumber,
      $city,
      $zipCode
      ) {
      $this->logo = $logo;
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->role = $role;
      $this->company = $company;
      $this->phone = $phone;
      $this->email = $email;
      $this->website = $website;
      $this->street = $street;
      $this->propertyNumber = $propertyNumber;
      $this->orientationNumber = $orientationNumber;
      $this->city = $city;
      $this->zipCode = $zipCode;
    }
    public function getFullAddress () {
      return "$this->street $this->propertyNumber / $this->orientationNumber , $this->city $this->zipCode";
    }
  }
?>