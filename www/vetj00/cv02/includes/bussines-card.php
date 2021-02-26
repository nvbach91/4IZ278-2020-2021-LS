<?php 

require './classes/Person.php';

$people = [];

array_push($people, new Person(
    'profilovka.jpg',
    'Jan',
    'Větrovský',
    21,
    'Web developer',
    'Such development company',
    'vetrovsky.jan@gmail.com',
    '+420773201372',
    'eso.vse.cz/~vetj00/cv01',
    'Jažlovická',
    1330,
    '149 00',
    'Prague'
));

array_push($people, new Person(
    'hans.jpg',
    'Hans',
    'Dutoschwartz',
    45,
    'Evil Genius',
    'Phineas and Ferb',
    'hans.evil@gmail.com',
    '+95646132',
    'eso.vse.cz/~vetj00/cv01',
    'Sonnenalle',
    666,
    '666 00',
    'Berlin'
));

?>

<h1>My card in PHP</h1>
<?php foreach($people as $person): ?>
    <div class="front">
        <img width="300" alt="logo" class="logo" src="./img/<?php echo $person->avatar; ?>">
        <div class="personal">
            <div class="name"><?php echo $person->firstName; ?></div>
            <div class="last-name"><?php echo $person->lastName; ?></div>
            <div class="job"><?php echo $person->job; ?></div>
            <div class="company"><?php echo $person->company; ?></div>
        </div>
    </div>
    <div class="back">
        <div class="back-name">
            <div class="name"><?php echo $person->firstName; ?></div>
            <div class="last-name"><?php echo $person->lastName; ?></div>
            <div class="job"><?php echo $person->job; ?></div>
        </div>
        <div class="back-data">
            <div><i class="fas fa-map-marker-alt"></i> <?php echo $person->getAddress(); ?></div>
            <div><i class="fas fa-phone"></i> <?php echo $person->phone ?></div>
            <div><i class="fas fa-at"></i> <?php echo $person->email ?></div>
            <div><i class="fas fa-globe"></i> <?php echo $person->webPage ?></div>
        </div>
    </div>
<?php endforeach; ?>