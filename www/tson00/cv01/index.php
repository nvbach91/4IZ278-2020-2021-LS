<?php

$avatar = 'logo-social.png';
$surname = 'Tsoy';
$name = 'Nadya';
//$age = '24';
$birthDate = "16/04/1996";
//explode the date to get month, day and year
$birthDate = explode("/", $birthDate);
//get age from date or birthdate
$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
  ? ((date("Y") - $birthDate[2]) - 1)
  : (date("Y") - $birthDate[2]));
//echo "Age is:" . $age;
$position = 'IT junior';
$companyname = 'Nadya s.r.o';
$street = 'far away';
$number = '9';
$numbero = '11';
$city = 'My city';
$phone = '911 911 911';
$email = 'tson00@vse.cz';
$webpage = 'mypage.com';
$avaib = 'yes';





?>
<!DOCTYPE html>
<html lang="en">
<style>
table {
  border: 1px solid black;
  width: 50%;
  margin-left: auto;
  margin-right: auto;

}
</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> firemní vizitku  </title>
</head>
<body>
    <table>
    <thead>
    <tr>
    <th coslpan = "2"></th>
    </tr>
    </thead>
    <tbody>
    <tr></tr>
      <tr><td colspan ="2" ><img src="<?php echo $avatar;?>" alt="logo" width="100" height="100"></td></tr>
      <tr><td>Příjmení</td><td><?php echo $surname;?></td></tr>
      <tr><td>Jméno</td><td><?php echo $name ?></td></tr>
      <tr><td>Věk </td><td><?php echo $age ;?></td></tr>
      <tr><td>Povolání</td><td><?php echo $position;?></td></tr>
      <tr><td>Název firmy</td><td><?php echo $companyname;?></td></tr>
      <tr><td>Ulice</td><td><?php echo $street ;?></td></tr>
      <tr><td>Číslo popisné</td><td><?php echo $number;?></td></tr>
      <tr><td>Číslo orientační</td><td><?php echo $numbero;?></td></tr>
      <tr><td>Město</td><td><?php echo $city;?></td></tr>
      <tr><td>Telefon</td><td><?php echo $phone;?></td></tr>
      <tr><td>Email</td><td><?php echo $email;?></td></tr>
      <tr><td>Webová stránka</td><td><?php echo $webpage;?></td></tr>
      <tr><td>dostupný</td><td><?php echo $avaib ;?></td></tr>
        </tbody>
    </table>
</body>
</html>