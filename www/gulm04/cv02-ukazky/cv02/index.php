<?php 

class Bcard {
    public function __construct($title, $name, $surname, $city, $phoneNumber, $email)
    {
        $this->title = $title;
        $this->name = $name;
        $this->surname = $surname;
        $this->city = $city;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
    }
}

$bcards = [
    new Bcard('Wayne corp.', 'Bruce', 'Wayne', 'Gotham', 'b-a-t-m-a-n', 'bruce@bat.com'),
    new Bcard('Wayne corp.', 'Jason', 'Todd', 'Gotham', 'r-e-d-h-o-o-d', 'jason@bat.com'),
    new Bcard('Wayne corp.', 'Richard', 'Grayson', 'Gotham', 'n-i-g-h-t-w-i-n-g', 'richard@bat.com'),
    new Bcard('Wayne corp.', 'Tim', 'Drake', 'Gotham', 'r-e-d-r-b-i-n', 'tim@bat.com'),
    new Bcard('Wayne corp.', 'Damian', 'Wayne', 'Gotham', 'r-o-b-i-n', 'damian@bat.com')
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
<h1>CV01 - i'm really sorry, but my first PHP-page sucks</h1>
    <h3>My business card in PHP</h3>
    <?php foreach($bcards as $bcard): ?>
    <div class="b-card">
        <div class="container">
            <div class="personal">
                <p class="title"><?php echo $bcard->title; ?></p>
                <p class="surname"><?php echo $bcard->surname; ?></p>
                <p class="name"><?php echo $bcard->name; ?></p>
            </div>
            <img src='./blacklogo.png' alt=" ">
        </div>
        <div class="contact">
            <p class="address"><?php echo $bcard->city; ?></p>
            <p class="phone"><?php echo $bcard->phoneNumber; ?></p>
            <p class="email"><?php echo $bcard->email; ?></p>
        </div>
    </div>
    <?php endforeach ?>
</body>
</html>