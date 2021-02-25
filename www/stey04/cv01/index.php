<?php
$logo = 'worm.jpg';
$photo = "img/paul.jpg";
$name = 'Paul';
$secondName = "Muad'Dib";
$city = 'Arrakis';
$phone = '+420 666 666 666';
$email = 'paul@dune.com';
$web = 'http://corndog.io/';
$status = 'Available';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js" integrity="sha512-UwcC/iaz5ziHX7V6LjSKaXgCuRRqbTp1QHpbOJ4l1nw2/boCfZ2KlFIqBUA/uRVF0onbREnY9do8rM/uT/ilqw==" crossorigin="anonymous"></script>
    <title>cv01</title>
</head>

<body>
    <div class="card front">

        <img src=<?php echo $photo ?> alt="paul-muad'dib">

        <div class="info">
            <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-location-arrow"></i></span><?php echo $city ?></li>
                <li><span class="fa-li"><i class="far fa-user"></i></span><?php echo $name . ' ' . $secondName; ?></li>
                <li><span class="fa-li"><i class="fas fa-phone-alt"></i></span><?php echo $phone ?></li>
                <li><span class="fa-li"><i class="fas fa-envelope-square"></i></span><?php echo $email ?></li>
                <li><span class="fa-li"><i class="fas fa-globe"></i></span><?php echo $web ?></li>
                <li><span class="fa-li"><i class="fas fa-bell"></i></span><?php echo $status ?></li>
            </ul>
        </div>
    </div>
    <div class="card back"></div>
</body>

</html>