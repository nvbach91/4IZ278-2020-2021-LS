<?php

require './helpers/utils.php';
require './Person.php';

$myCards = array(
    new Person(
            'battery.png',
        'Test',
        'Tester',
        'Testovací / Tester',
        'Battery inc',
        '+420 222 333 444',
        'test@battery.com',
        'www.battery.com',
        'Ulicová',
        23,
        189,
        'Testering',
        '4.5.1992'
    ),
    new Person(
        'battery.png',
        'Test2',
        'Tester2',
        'Testovací / Tester',
        'Battery inc',
        '+420 222 333 445',
        'test2@battery.com',
        'www.battery.com',
        'Ulicová',
        5,
        125,
        'Testering',
        '4.5.1995'
    ),
    new Person(
        'battery.png',
        'Test3',
        'Tester3',
        'Testovací / Tester',
        'Battery inc',
        '+420 222 333 446',
        'test3@battery.com',
        'www.battery.com',
        'Ulicová',
        6,
        130,
        'Testering',
        '4.5.1985'
    )
);

?>

<?php foreach ($myCards as $person): ?>
<div class="card-block">
    <div class="card card-top">
        <div class="card-left">
            <img src="./img/<?php echo $person->logo; ?>" alt="baterka"/>
        </div>
        <div class="card-right">
            <p><?php echo $person->getFullName(); ?></p>
            <p><?php echo $person->position; ?></p>
            <p><?php echo $person->company; ?></p>
            <p><?php echo $person->phone; ?></p>
            <p><?php echo $person->mail; ?></p>
            <p><?php echo $person->web; ?></p>
            <p><?php echo $person->getBuddyAdress(); ?></p>
            <p><?php echo 'Věk: ' . $person->getAge(); ?></p>
        </div>
    </div>
    <div class="space"></div>
    <div class="card card-back">
        <img src="./img/<?php echo $person->logo; ?>" alt="baterka"/>
    </div>
</div>
    <?php $person->getAge(); ?>
<?php endforeach; ?>