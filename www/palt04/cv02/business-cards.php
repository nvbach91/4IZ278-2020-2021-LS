<?php

require './classes/Person.php';

$people = [];

array_push($people, new Person(
    'jedi-logo.svg',
    'Timotej',
    'Paluš',
    "6-11-1999",
    'Profesional Student',
    'Lucky Strike',
    '+420 775 456 789',
    'palt04@vse.cz',
    'www.vse.cz',
    true,
    'Temple of Edit',
    43,
    121,
    'Praha'
));

array_push($people, new Person(
    'linux.svg',
    'Ježiško',
    'Americký',
    "1000-11-6",
    'Profesional giver',
    'Santa Claus',
    '+420 999 999 999',
    'ježiško@hotmail.com',
    'www.amazon.cz',
    true,
    'Temple of Edit',
    43,
    121,
    'Cleveland'
));

array_push($people, new Person(
    'lbj.png',
    'Lebron',
    'James',
    "1983-12-30",
    'Profesional Basketbal player',
    'NBA',
    '+423 999 999 999',
    'chosen1@hotmail.com',
    'www.nba.com',
    true,
    'Temple of Edit',
    43,
    121,
    'Ohio'
));

?>

<?php foreach($people as $person): ?>
    <h1 class="text-center">Card of <?php echo $person->firstName?></h1>
    <div class="business-card bc-front row">
            <div class="col-4 text-center">
                <img src="./img/<?php echo $person->avatar?>" class="img img-fluid" alt="">
            </div>
            <div class="col-8 text-center">
                <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                <div class="bc-title"><?php echo $person->title; ?></div>
                <div class="bc-company"><?php echo $person->company; ?></div>
            </div>
        </div>
        <div class="business-card bc-back row">
            <div class="col-6">
                <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                <div class="bc-title"><?php echo $person->title ?></div>
            </div>
            <div class="col-6 contacts">
                <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $person->getAddress(); ?></div>
                <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $person->phone; ?></div>
                <div class="bc-email"><i class="fas fa-at"></i> <?php echo $person->email; ?></div>
                <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $person->website; ?></div>
                <div class="bc-website">Age: <?php echo $person->getAge(); ?></div>
                <div class="bc-available"><?php echo $person->getAvailability() ? 'Not available for contracts' : 'Now available for contracts'; ?></div>
            </div>
        </div>
    </div>
<?php endforeach; ?>