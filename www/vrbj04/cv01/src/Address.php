<?php


final class Address {
    /**
     * @var string
     */
    public $street;

    /**
     * @var string
     */
    public $streetNumber;

    /**
     * @var string
     */
    public $city;

    public function __construct($street, $streetNumber, $city) {
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->city = $city;
    }
}