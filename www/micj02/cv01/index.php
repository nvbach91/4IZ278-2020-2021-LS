<?php
// tohle je  komentar

$name = 'Tony';
$surname = 'Stark';
$full_name = "$name $surname";
$street = 'Americka';
$number = '1000/5';
$city = 'Praha';
$adress = "$street $number, $city";
$phone = '+420 123 123 123';
$mail = 'tony@stark.indistries.com';
$website = 'www.stark.com';
$image = 'https://dailysuperheroes.com/wp-content/uploads/2020/02/tony-stark.jpg'


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
      align-items: center;
      color: #333;
      display: flex;
      font-family: sans-serif;
      justify-content: center;
      margin: 0;
      min-height: 100vh;
    }
    h2, ul {
      margin-top: 0;
    }
    hr {
      margin: 2px 0 4px;
    }
    img {
      border-radius: 50%;
      height: 200px;
      margin-right: 50px;
      object-fit: cover;
      width: 200px;
    }
    section {
      align-items: center;
      border: 2px solid grey;
      box-shadow: 10px 10px 5px rgba(0,0,0,0.3);
      display: flex;
      padding: 40px;
    }
    span {
      color: #555;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <section>
    <img src="<?php echo $image?>" />
    <div>
      <h2><?php echo $full_name?></h2>
      <hr/>
      <ul>
        <li><?php echo $adress?></li>
        <li><?php echo $phone?></li>
        <li><?php echo $mail?></li>
        <li><?php echo $website?></li>
      </ul>
    </div>
  </section> 

</body>
</html>