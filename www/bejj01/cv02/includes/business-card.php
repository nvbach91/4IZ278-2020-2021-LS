<?php
require './classes/Person.php';

$people = [
    new Person(
        'Jakub',
        'Bejvl', 
        'jedi-logo.svg',
        'Total Nerd', 
        'Not A Real Company',
        '+420 777 888 999', 
        'jbejvl@gmail.com',
        'www.jbejvl.com', 
        new DateTime('1996/09/05'),
        false, 
        'U Retexu',
        624, 
        3, 
        'Klatovy'
    ),
    new Person(
        'Frodo',
        'Baggins', 
        'lotr-logo.png',
        'Ringbearer',
        'Fellowship of the Ring',
        '+420 111 222 333', 
        'frodo@gmail.com',
        'www.frodogeek.com',
        new DateTime('1970/01/01'),
        true, 
        'Bag End',
        12, 
        1, 
        'Hobbiton'
    ),
    new Person(
        'Bilbo', 
        'Baggins', 
        'hobbit-logo.png',
        'Thief', 
        'Company of Thorin Oakenshield',
        '+420 111 232 333', 
        'bilbo@gmail.com',
        'www.bilbobaggins.com',
        new DateTime('1950/01/01'),
        true, 
        'Bag End',
        12,
        1,
        'Hobbiton'
    ),
];

?>

<?php foreach($people as $person): ?>
    <div class="business-card bc-front row">
        <div class="col-sm-4">
            <div class="logo" style="background-image: url(img/<?php echo $person->logo; ?>)"></div>
        </div>
        <div class="col-sm-8">
            <div class="bc-firstname"><?php echo $person->firstName; ?></div>
            <div class="bc-lastname"><?php echo $person->lastName; ?></div>
            <div class="bc-title"><?php echo $person->title; ?></div>
            <div class="bc-company"><?php echo $person->company; ?></div>
        </div>
    </div>
    <div class="business-card bc-back row">
        <div class="col-sm-6">
            <div class="bc-firstname"><?php echo $person->firstName; ?></div>
            <div class="bc-lastname"><?php echo $person->lastName; ?></div>
            <div class="bc-title"><?php echo $person->title ?></div>
        </div>
        <div class="col-sm-6 contacts">
            <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $person->getAddress(); ?></div>
            <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $person->phone; ?></div>
            <div class="bc-email"><i class="fas fa-at"></i> <?php echo $person->email; ?></div>
            <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $person->website; ?></div>
            <div class="bc-available"><?php echo $person->isAvailableForOffers() ?></div>
        </div>
    </div>
    <br>
<?php endforeach; ?>