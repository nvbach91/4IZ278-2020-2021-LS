<?php
    $name = "Kryštof Blažej";
    $age = 23;  //int
    $decimal = 23.21;  //float/double
    $boolean = true;  //true/false, muze byt i 0 a jine cislo
    //objekt, pole
    $person = [
        'name' => 'petr',
        'age' => 22,
    ];
    //jednoduche pole
    $fruits = ['kiwi', 'orange', 'banana'];

    $nothing = null;

    //ukol1
    $name = "Kryštof Blažej";
    $age = 22;  //int
    $street = "Jordana Jovkova";
    $number = "3261/21";
    $city = "Praha";
    $email = "blazej.krystof@gmail.com";
    $phone = "732478833";
    $position = "Obchodní zástupce";
    $companyName = "Pivoteka Modrany";


    $address = $street . ' ' . $number.', ' . $city;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Business Card</title>
</head>
<body>
    <h1>Business Card</h1>
    <div class="card">
        <div class="left">
            <img alt="company-logo" src="logo.png">
        </div>
        <div class="right">
            <h2><?php echo $name ?></h2>
            <p><?php echo $position ?> - </p>
            <p>- <?php echo $companyName ?> -</p>
            <ul>
                <li>Adr: <?php echo $address ?></li>
                <li>Tel: <?php echo $phone ?></li>
                <li>Mail: <a href="<?php echo $email ?>"><?php echo $email ?></a>
            </ul>
        </div>
    </div>
</body>
</html>