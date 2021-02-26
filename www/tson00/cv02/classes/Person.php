<?php
class Person{
  public function __construct($avatar, $surname, $name, $birthDate,$position,$companyname,$street,$number,$numbero,$city,$phone,$email,$webpage,$avaib){
      $this->avatar = $avatar;
      $this->surname = $surname;
      $this->name = $name;
      $this->birthDate = $birthDate;
      $this->position = $position;
      $this->companyname = $companyname;
      $this->street = $street;
      $this->number = $number;
      $this->numbero = $numbero;
      $this->city = $city;
      $this->phone = $phone;
      $this->email = $email;
      $this->webpage = $webpage;
      $this->avaib = $avaib;
  }   
  public function getAddress(){
        return "Ulice: $this->street <br>
        Číslo popisné: $this->number <br>
        Číslo orientační: $this->numbero <br>
        Město: $this->city";
    }
    public function getFullName(){
      return "Jméno: $this->surname <br> Příjmení: $this->name";
    }
    public function getAge(){
      $age = countAge($this->birthDate);
      return "Věk: $age";
    }
   }
  ?>