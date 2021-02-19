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
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
.styl{
  margin: auto;
  width: 70%;
  margin-top:5%;
  border-style: groove;
  border-width: 7px;
  border-color: lightblue;
  padding: 10px;
  top:5%;
  background: linear-gradient(to bottom, #33ccff 0%, #003300 100%);
  color: white;
  text-align: center;
  font-size: 18px;
  font-family: "Lucida Console", "Courier New", monospace;
}
img{
  border-radius: 50%;
}
</style>
    <title> Firemní vizitka  </title>
</head>
<body>
  <div class="styl">
   <div class="container-fluid">
    <div style="clear: left;">
      <p style="float: left;"><img src="<?php echo $avatar;?>" height="320px" width="390px" border="1px"></p>
      <p><div class="container-fluid">Příjmení:<?php echo $surname;?><br>
      Jméno: <?php echo $name; ?><br>
      Věk: <?php echo $age ;?><br>
      Povolání: <?php echo $position;?><br>
      Název firmy: <?php echo $companyname;?><br>
      Ulice:  <?php echo $street ;?> <br>
      Číslo popisné: <?php echo $number;?> <br>
      Číslo orientační: <?php echo $numbero;?> <br>
      Město:   <?php echo $city;?> <br>
      Telefon:     <?php echo $phone;?> <br>
      Email: <?php echo $email;?><br>
      <a href="https://eso.vse.cz/~tson00/cv01/" style="color:white;">Webová stránka: <?php echo $webpage;?></a><br>
      dostupný:  <?php echo $avaib ;?></p>
    </div>
  </div>
 </div>
</div>
</body>
</html>