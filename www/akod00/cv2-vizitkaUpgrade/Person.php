<?php

  class Person
  {
    private string $title;
    private string $logo;
    private string $firstname;
    private string $lastname;
    private string $company;
    private string $phone;
    private string $email;
    private string $website;
    private string $available;
    private string $address;

    public function __construct(string $title, string $logo, string $firstname, string $lastname, string $company, string $phone, string $email, string $website, string $available, string $address)
    {
      $this->logo = $logo;
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->company = $company;
      $this->phone = $phone;
      $this->email = $email;
      $this->website = $website;
      $this->available = $available;
      $this->address = $address;
      $this->title = $title;
    }

    public function getLogo(): string
    {
      return $this->logo;
    }

    public function getFirstname(): string
    {
      return $this->firstname;
    }

    public function getLastname(): string
    {
      return $this->lastname;
    }

    public function getCompany(): string
    {
      return $this->company;
    }

    public function getPhone(): string
    {
      return $this->phone;
    }

    public function getEmail(): string
    {
      return $this->email;
    }

    public function getWebsite(): string
    {
      return $this->website;
    }

    public function getAvailable(): string
    {
      return $this->available;
    }

    public function getAddress(): string
    {
      return $this->address;
    }

    public function getTitle(): string
    {
      return $this->title;
    }

  }
