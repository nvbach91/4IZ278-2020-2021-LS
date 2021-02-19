<?php

//Avatar nebo Logo firmy
$imageUrl = "https://upload.wikimedia.org/wikipedia/commons/1/1e/RPC-JP_Logo.png";
// Příjmení
$lastName = "Kortoshkina";
// Jméno
$firstName = "Katerina";
// Věk (výpočet z datumu narození)
$birthday = 1997;
$year = 2021;
$age = $year - $birthday;
// Povolání nebo Pozice
$position = "Student";
// Název firmy
$workplace = "VSE";
// Ulice
$street = "nám. W. Churchilla";
// Číslo popisné
$number1 = 1938;
// Číslo orientační
$number2 = 4;
$number = "$number1/$number2";
// Město / Městská část
$city = "Praha";
// Telefon
$phone = "777888999";
// Osobní e-mail / firemní e-mail
$email = "ekortoshkina@seznam.cz";
// Webová stránka
$web = "www.web.cz";
// Zda jste dostupný k pracovním nabídkám
$isAvailable = true;

if ($isAvailable) {
    $availability = "Dostupná k pracovním nabídkám";
} else {
    $availability = "Nedostupná k pracovním nabídkám";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:wght@400;600&family=Open+Sans:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <main class="main">
        <div class="front wrapper">
            <div class="front__logo">
                <img src="<?php echo $imageUrl; ?>" width="100" heigth="100" alt="Logo">
            </div>
            <div class="container">
                <p class="front__name text"><?php echo $lastName; ?> <?php echo $firstName; ?></p>

                <p class="front__work text"><?php echo $position; ?></p> 
                <span class="front__age text"><?php echo $age; ?></span>
            </div>

        </div>
        <div class="back wrapper">
            <p class="back__address text"><?php echo $workplace . ': ' . $city . ', ' . $street . ' ' . $number; ?></p>
            <p class="back__phone text"><?php echo $phone; ?></p>
            <p class="back__email text"><?php echo $email; ?></p>
            <p class="back__web text"><?php echo $web; ?></p>
            <p class="back__availability text"><?php echo $availability; ?></p>
        </div>
    </main>
</body>

</html>