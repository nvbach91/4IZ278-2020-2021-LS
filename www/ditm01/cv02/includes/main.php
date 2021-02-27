<?php require './classes/person.php' ?>
<?php

$superheroes = [
    new Person(
        'batman_logo.png',
        'Wayne',
        'Bruce',
        'Thomas',
        'superhero',
        'Wayne Enterprises',
        'Batcave',
        12,
        9,
        'Gotham City',
        '(555) 555-1234',
        'batman@justiceleague.com',
        'justiceleague.com',
        'Available for serving justice',
        '17.4.1978'
    ),
    new Person(
        'superman_logo.png',
        'Kent',
        'Clark',
        'Joseph',
        'superhero',
        'Daily Planet',
        'New Troy',
        35,
        5,
        'Metropolis',
        '(555) 876-1254',
        'superman@justiceleague.com',
        'justiceleague.com',
        'Available for helping',
        '28.2.1982'
    ),
    new Person(
        'flash_logo.png',
        'Allen',
        'Barry',
        'Bartholomew',
        'superhero',
        'Central City Police',
        'Leawood',
        54,
        2,
        'Central City',
        '(555) 123-5774',
        'flash@justiceleague.com',
        'justiceleague.com',
        'Available for speed',
        '2.11.1985'
    )
];
?>

<?php foreach ($superheroes as $hero) : ?>
    <div class="business-card">
        <div class="left-side">
            <div class="avatar">
                <img class="logo" src="./img/<?php echo $hero->avatar; ?>">
            </div>
        </div>
        <div class="right-side">
            <div class="name"><?php echo $hero->getFullName(); ?></div>
            <div class="profession"><?php echo $hero->profession; ?></div>
            <div class="fulladdress"><?php echo $hero->getAge(); ?></div>
            <div class="phone"><?php echo $hero->company; ?></div>
            <div class="fulladdress"><?php echo $hero->getAddress(); ?></div>
            <div class="phone"><?php echo $hero->phone; ?></div>
            <div class="email"><?php echo $hero->email; ?></div>
            <div class="web"><?php echo $hero->web; ?></div>
            <div class="availability"><?php echo $hero->availability; ?></div>
        </div>
    </div>
<?php endforeach; ?>