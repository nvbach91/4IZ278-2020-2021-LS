<?php
 function countAge($date){
    //explode the date to get month, day and year
    $birthDate = explode("/", $date);
    //get age from date or birthdate
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));
    //echo "Age is:" . $age;
    return $age;
}
?>