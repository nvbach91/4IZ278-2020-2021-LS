<?php require './utils.php' ?>
<?php 

class Person {
    public function __construct($lastName, $firstName, $birthday, $position, $workplace, $street, $firstHouseNumber, $secondHouseNumber, $city, $phone, $email, $web, $available, $logoUrl){
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->birthday = $birthday;
        $this->position = $position;
        $this->workplace = $workplace;
        $this->street = $street;
        $this->firstHouseNumber = $firstHouseNumber;
        $this->secondHouseNumber = $secondHouseNumber;
        $this->city = $city;
        $this->available = $available;
        $this->phone = $phone;
        $this->email = $email;
        $this->web = $web;
        $this->logoUrl = $logoUrl;
    } 

    public function getFullName() {
        return "$this->lastName $this->firstName";
    }

    public function getAddress() {
        return "$this->street $this->firstHouseNumber/$this->secondHouseNumber, $this->city";
    }

    public function getAge() {
        return countAge($this->birthday);
    }

    public function getAvailability() {
        return $this->available ? "Dostupná k pracovním nabídkám" : "Nedostupná k pracovním nabídkám";
    }
}

?>