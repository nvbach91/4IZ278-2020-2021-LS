<?php
$logo = 'unnamed.png';                  
$firstName = 'Lukáš';
$lastName = 'Vávra';
$age = 21;
$function = 'Web developer';
$company = 'Siemens s.r.o';
$phone = '+420 605 789 464';
$email = 'lukas.vavra@siemens.com';
$website = 'www.lukyvavra.wz.cz';
$frontend = 'HTML+CSS+JS';
$backend ='PHP+Node.js';
$frameworks = 'Angular';

$skills = $frontend . ' ' . $backend. '/' . $frameworks;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <main class="container">
        <div class="my-card">
            <div class="col-sm-6">
                <div class="firstname"><?php echo $firstName; ?></div>
                <div class="lastname"><?php echo $lastName; ?></div>
                <div class="function"><?php echo $function; ?></div>
                <div class="company"><?php echo $company; ?></div>

            </div>
            <div class="col-sm-6">
                <div class="address"> <?php echo $skills; ?></div>
                <div class="phone"> <?php echo $phone; ?></div>
                <div class="email"> <?php echo $email; ?></div>
                <div class="website"> <?php echo $website; ?></div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
</body>

</html>