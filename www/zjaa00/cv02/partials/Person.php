<?php
class Person
{

  function __construct(
    $firstname,
    $lastname,
    $birthDate,
    $title,
    $company,
    $street,
    $desc_number,
    $ref_number,
    $district,
    $phone,
    $email,
    $website,
    $available
  ) {
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->birthDate = $birthDate;
    $this->title = $title;
    $this->company = $company;
    $this->street = $street;
    $this->desc_number = $desc_number;
    $this->ref_number = $ref_number;
    $this->district = $district;
    $this->phone = $phone;
    $this->email = $email;
    $this->website = $website;
    $this->available = $available;
  }

  function get_firstname()
  {
    return $this->firstname;
  }

  function get_lastname()
  {
    return $this->lastname;
  }

  function get_birthDate()
  {
    return $this->birthDate;
  }

  function get_title()
  {
    return $this->title;
  }

  function get_company()
  {
    return $this->company;
  }

  function get_street()
  {
    return $this->street;
  }

  function get_desc_number()
  {
    return $this->desc_number;
  }

  function get_ref_number()
  {
    return $this->ref_number;
  }

  function get_district()
  {
    return $this->district;
  }

  function get_phone()
  {
    return $this->phone;
  }

  function get_email()
  {
    return $this->email;
  }

  function get_website()
  {
    return $this->website;
  }

  function get_available()
  {
    return $this->available;
  }
}