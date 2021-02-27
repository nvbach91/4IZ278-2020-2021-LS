<?php require './class/Person.php' ?>
<?php require './utils.php' ?>

<?php
$persons = [];

array_push($persons, new Person(
    'jedi-logo.svg',
    'Anakin',
    'Skywalker',
    '08/05/1998',
    'Lead Developer / Architect',
    'First Order Jedi Council',
    '+420 777 888 999',
    'skywalker@jedi-council.com',
    'www.jedi-council.com',
    false,
    'Temple of Eedit',
    42,
    121,
    'Coruscant',
));

array_push($persons, new Person(
    'jedi-logo.svg',
    'Michael',
    'Bruna',
    '08/06/1999',
    'Web developer',
    'LogiWeb',
    '+420 777 888 999',
    'brum08@vse.cz',
    'www.wbdevelop.com',
    false,
    'Husinecka',
    52,
    13,
    'Prague',
));
?>


<h1 class="text-center">My Business Card in PHP</h1>
<?php foreach ($persons as $person) : ?>
    <div class="business-card bc-front row">
        <div class="col-sm-4">
            <div class="logo" style="background-image: url(./img/<?php echo $person->avatar; ?>)"></div>
        </div>
        <div class="col-sm-8">
            <div class="bc-firstname"><?php echo $person->firstName; ?></div>
            <div class="bc-lastname"><?php echo $person->lastName; ?></div>
            <div class="bc-age"><?php echo getAge($person->dateOfBirth); ?></div>
            <div class="bc-title"><?php echo $person->title; ?></div>
            <div class="bc-company"><?php echo $person->company; ?></div>
        </div>
    </div>
    <div class="business-card bc-back row">
        <div class="col-sm-6">
            <div class="bc-firstname"><?php echo $person->getFullName(); ?></div>
            <div class="bc-title"><?php echo $person->title; ?></div>
        </div>
        <div class="col-sm-6 contacts">
            <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $person->getAdress(); ?></div>
            <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $person->phone; ?></div>
            <div class="bc-email"><i class="fas fa-at"></i> <?php echo $person->email; ?></div>
            <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $person->website; ?></div>
            <div class="bc-available"><?php echo $person->available ? 'Not available for contracts' : 'Now available for contracts'; ?></div>
        </div>
    </div>
<?php endforeach; ?>