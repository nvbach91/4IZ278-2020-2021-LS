<?php
declare(strict_types=1);

class Address
{
    private $street;
    private $numberOrientative;
    private $numberDescriptive;
    private $city;
    private $postcode;

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    /**
     * @return int
     */
    public function getNumberOrientative()
    {
        return $this->numberOrientative;
    }

    /**
     * @param int $numberOrientative
     */
    public function setNumberOrientative(int $numberOrientative)
    {
        $this->numberOrientative = $numberOrientative;
    }

    /**
     * @return int
     */
    public function getNumberDescriptive()
    {
        return $this->numberDescriptive;
    }

    /**
     * @param int $numberDescriptive
     */
    public function setNumberDescriptive(int $numberDescriptive)
    {
        $this->numberDescriptive = $numberDescriptive;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * @return int
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param int $postcode
     */
    public function setPostcode(int $postcode)
    {
        $this->postcode = $postcode;
    }

    public function buildStreetWithNumbers()
    {
        return $this->getStreet() . ' ' . $this->getNumberOrientative() . '/' . $this->getNumberOrientative();
    }


}