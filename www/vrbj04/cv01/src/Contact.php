<?php

use Cassandra\Date;

require __DIR__ . "/Address.php";


final class Contact {

    /**
     * @var string
     */
    public $avatar;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $surname;

    /**
     * @var DateTime
     */
    public $birth;

    /**
     * @var string
     */
    public $job;

    /**
     * @var string 
     */
    public $company;

    /**
     * @var Address
     */
    public $address;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $website;

    /**
     * @var bool
     */
    public $availableForHire;

    public function __construct($avatar, $name, $surname, $birth, $job, $company, $address, $phone, $email, $website, $availableForHire) {
        $this->avatar = $avatar;
        $this->name = $name;
        $this->surname = $surname;
        $this->birth = $birth;
        $this->job = $job;
        $this->company = $company;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->availableForHire = $availableForHire;
    }
}