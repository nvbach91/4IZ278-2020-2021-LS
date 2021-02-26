<?php

 function getFullName($firstName,$lastName) {
        return $firstName. ' ' . $lastName;
    }

 function getAge($birthDate){
        $birthDate = explode("/", $birthDate);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
          ? ((date("Y") - $birthDate[2]) - 1)
          : (date("Y") - $birthDate[2]));
        return "Age: $age";
    }

 function getAddress($street,$propNumber,$orientationNumber,$city) {
        return "$street $propNumber / $orientationNumber, $city";
    }
?>