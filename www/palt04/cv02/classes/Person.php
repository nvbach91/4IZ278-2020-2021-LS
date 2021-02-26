<?php

/**
 * Class Person
 */
class Person{

//   private $firstName;     
//   private $lastName;
//   private $title;
//   private $company;      
//   private $phone;
//   private $email;
//   private $website;      
//   private $available;
//   private $street;
//   private $propertyNumber;      
//   private $orientationNumber;
//   private $city;
//   private $dateOfBirth;

  public function __construct($avatar,$firstName,$lastName,$dateOfBirth,$title,$company,$phone,$email,$website,$available,$street,$propertyNumber,$orientationNumber, $city){
    $this->avatar = $avatar;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->title = $title;
    $this->company = $company;
    $this->available = $available;
    $this->phone = $phone;
    $this->email = $email;
    $this->website = $website;
    $this->street = $street;
    $this->propNumber = $propertyNumber;
    $this->orientationNumber = $orientationNumber;
    $this->city = $city;
    $this->dateOfBirth = $dateOfBirth;
  }

  public function getAddress(){
      return "$this->street $this->propNumber/$this->orientationNumber, $this->city";
  }

  public function getAvailability() {
    return $this->available ? 'Not available for contracts' : 'Now available for contracts';
  }

  public function getAge(){
    if(!empty($this->dateOfBirth)){
      $birthdate = new DateTime($this->dateOfBirth);
      $today   = new DateTime('today');
      $age = $birthdate->diff($today)->y;
      return $age;
  }else{
      return 0;
  }
    // $today = date("Y-m-d");
    // $diff = date_diff(date_create($this->dateOfBirth), date_create($today));
    // return $diff;
  }
}
?>