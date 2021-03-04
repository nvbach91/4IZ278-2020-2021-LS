<?php 

require "BusinessCard.php";

$bcards = [
    new BusinessCard('Wayne corp.', 'Bruce', 'Wayne', 'Gotham', 'b-a-t-m-a-n', 'bruce@bat.com'),
    new BusinessCard('Wayne corp.', 'Jason', 'Todd', 'Gotham', 'r-e-d-h-o-o-d', 'jason@bat.com'),
    new BusinessCard('Wayne corp.', 'Richard', 'Grayson', 'Gotham', 'n-i-g-h-t-w-i-n-g', 'richard@bat.com'),
    new BusinessCard('Wayne corp.', 'Tim', 'Drake', 'Gotham', 'r-e-d-r-b-i-n', 'tim@bat.com'),
    new BusinessCard('Wayne corp.', 'Damian', 'Wayne', 'Gotham', 'r-o-b-i-n', 'damian@bat.com')
];

?>
    <h1>My Business Card in PHP - OOP</h1>
    <?php foreach($bcards as $bcard): ?>
        <div class="b-card">
            <div class="container">
                <div class="personal">
                    <p class="title"><?php echo $bcard->title; ?></p>
                    <p class="surname"><?php echo $bcard->surname; ?></p>
                    <p class="name"><?php echo $bcard->name; ?></p>
                </div>
                <img src="./styles/blacklogo.png" alt=" ">
            </div>
            <div class="contact">
                <p class="address"><?php echo $bcard->city; ?></p>
                <p class="phone"><?php echo $bcard->phoneNumber; ?></p>
                <p class="email"><?php echo $bcard->email; ?></p>
            </div>
        </div>
    <?php endforeach ?>