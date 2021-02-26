<?php
function getAddress($person)
{
  $address = $person->get_street() . " " . $person->get_desc_number() . "/" . $person->get_ref_number() . ", " . $person->get_district();
  return $address;
}

function getFullName($person)
{
  $full_name = $person->get_firstname() . " " . $person->get_lastname();
  return $full_name;
}

function calc_age($person)
{
  $birthDate = explode(".", $person->get_birthDate());
  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));
  return $age;
}
