<?php
require __DIR__ . '/../Classes/Person.php';
require __DIR__ . '/../Classes/Address.php';

class PersonFactory
{
    public function createPersonOne(): Person
    {
        $person = new Person();
        $person->setName('Adam');
        $person->setSurname('Pesek');
        $person->setDateOfBirth(new DateTime('1999-07-13'));
        $person->setEmail('pesa06@vse.cz');
        $person->setPhone('+420 100 100 100');
        $person->setPosition('developer');
        $person->setWebsite('vse.cz');
        $person->setAddress($this->createFirstAddress());
        $person->setCompanyName('Vyvojarska firma');
        $person->setOpenToPositions(true);
        return $person;
    }

    private function createFirstAddress(): Address
    {
        $address = new Address();
        $address->setStreet('Testovaci ulice');
        $address->setNumberOrientative(1);
        $address->setNumberDescriptive(10);
        $address->setPostcode(12345);
        $address->setCity('Praha');
        return $address;
    }

    public function createPersonTwo(): Person
    {
        $person = new Person();
        $person->setName('Osoba');
        $person->setSurname('Druha');
        $person->setDateOfBirth(new DateTime('2009-01-01'));
        $person->setEmail('test@vse.cz');
        $person->setPhone('+420 200 300 400');
        $person->setPosition('tester');
        $person->setWebsite('vse.cz');
        $person->setAddress($this->createSecondAddress());
        $person->setCompanyName('Testerska firma');
        $person->setOpenToPositions(false);
        return $person;
    }

    private function createSecondAddress(): Address
    {
        $address = new Address();
        $address->setStreet('Druha testovaci ulice');
        $address->setNumberOrientative(2);
        $address->setNumberDescriptive(20);
        $address->setPostcode(54321);
        $address->setCity('Brno');
        return $address;
    }

}