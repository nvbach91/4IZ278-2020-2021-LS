<?php

require './classes/Person.php';
require './utils/utils.php';

$people = [];

array_push($people, new Person(
    'dog.png',
    'Nostradamus',
    'von Buranos Lobos',
    'Puppy',
    'Agro Povlčín',
    '+420 999 999 999',
    'nostik@povlcin.com',
    'Povlcin',
    159,
    27004,
    'Milostin',
    '12/12/2020'
));

array_push($people, new Person(
    'girl.jpg',
    'Markéta',
    'Palkosková',
    'Královna Povčlínská',
    'Elka Group s.r.o',
    '+420 777 777 777',
    'marky@palky.com',
    'Pařížksá',
    1,
    12000,
    'Praha',
    '03/11/1997'
));

array_push($people, new Person(
    'boy.jpg',
    'Lukáš',
    'Vávra',
    'sluha',
    'Doma',
    '+420 666 666 666',
    'vavl03@vse.cz',
    'Pod Nemocnicí',
    2345,
    26901,
    'Atlanta',
    '07/12/1999'
));

?>
<?php foreach($people as $person): ?>
    <div class="row">
        <div class="business-card">
        <div class="col-sm-4">
                <div class="logo" style="background-image: url(./img/<?php echo $person->avatar; ?>)"></div>
            </div>
            <div class="col-sm-8">
                <div class="firstname"><?php echo $person->firstName; ?></div>
                <div class="lastname"><?php echo $person->lastName; ?></div>
                <div class="title"><?php echo $person->title; ?></div>
                <div class="company"><?php echo $person->company; ?></div>
            </div>
        </div>
        <div class="business-card back">
            <div class="col-sm-6">
                <div class="firstname"><?php echo getFullName($person->firstName,$person->lastName); ?></div>
                <div class="title"><?php echo $person->title; ?></div>
                <div class="age"><?php echo getAge($person->birthDate); ?></div>

            </div>
            <div class="col-sm-6 contacts">
                <div class="address"></i> <?php echo getAddress($person->street,$person->propNumber,$person->orientationNumber,$person->city); ?></div>
                <div class="phone"></i> <?php echo $person->phone; ?></div>
                <div class="email"></i> <?php echo $person->email; ?></div>
            </div>
        </div>
    </div>
<?php endforeach; ?>