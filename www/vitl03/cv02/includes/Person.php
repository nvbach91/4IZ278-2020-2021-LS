<?php include './utils.php'; ?>
<?php
class Person
{
    public function __construct($fullName, $address, $dateOfBirth, $email, $phone, $web, $availableForOffers)
    {
        $this->fullName = $fullName;
        $this->address = $address;
        $this->dateOfBirth = $dateOfBirth;
        $this->email = $email;
        $this->phone = $phone;
        $this->web = $web;
        $this->availableForOffers = $availableForOffers;
    }
    public function getAddress()
    {
        return "$this->address";
    }
    public function getFullName()
    {
        return "$this->fullName";
    }
    public function getAge()
    {
        $dateOfBirth = "$this->dateOfBirth";
        $today = date("d-m-Y");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        return $diff->format('%y');
    }
  

}
$people = [
    new Person('Lukáš Vít', 'Budějovická 11', '12-02-2000', 'lukasvit@email.com', '773 829 012', 'lvit.cz', 'false'),
    new Person('Martin Novák', 'Bruselská 11', '14-05-1967', 'martinovak@email.com', '720 839 012', 'tnov.cz', 'true'),
    new Person('Tomáš Kos', 'Lovosická 83', '15-07-2005', 'tomaskos@email.com', '729 429 012', 'tkos.cz', 'false'),
]

?>