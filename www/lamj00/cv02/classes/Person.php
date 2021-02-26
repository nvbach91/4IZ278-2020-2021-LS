
<?php
class Person{
    public function __construct($avatar,$firstName, $lastName,$title,$company, $phone, $email,$website,$available,$street,$propertyNumber,$orientationNumber,$city,$dateOfBirth) {
        $this->avatar = $avatar;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->title = $title;
        $this->company = $company;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->available = $available;
        $this->street = $street;
        $this->propertyNumber = $propertyNumber;
        $this->orientationNumber = $orientationNumber;
        $this->city = $city;
        $this->dateOfBirth = $dateOfBirth;

    }
    public function getAdress(){
        return $this->street . ' ' . $this->propertyNumber . '/' . $this->orientationNumber . ', ' . $this->city;
    }
    public function getFullName(){
        return $this->firstName . ' ' . $this->lastName ;
    }
    public function getAge(){
        $diff = date_diff(date_create($this->dateOfBirth), date_create(date("Y-m-d")));
        return $diff->format('%y');
    }
};
?>
