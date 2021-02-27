<?php
require "./classes/Person.php";
$alex = new Person(
    'ALEXANDRA',
    'FEDINA',
    'F',
    'Reklamní manažer',
    'Styling',
    'REKLAMA',
    'Vavilova 69/2',
    'Rostov-na-Donu',
    '+420777666555',
    'alex-dzhan',
    date_create("30.01.2001")
);

$natalya = new Person(
    'NATALYA',
    'FEDINA',
    'F',
    'Reklamní manažer',
    'Styling',
    'REKLAMA',
    'Vavilova 69/2',
    'Rostov-na-Donu',
    '+420666555444',
    'natalya',
    date_create("20.01.1971")
);

$sergey = new Person(
    'SERGEY',
    'FEDIN',
    'M',
    'Ředitel',
    'Styling',
    'REKLAMA',
    'Vavilova 69/2',
    'Rostov-na-Donu',
    '+420444333222',
    'fedinsv',
    date_create("23.02.1971")
);

$persons = array(
    $alex,
    $natalya,
    $sergey
);

?>

<?php foreach ($persons as $key): ?>
    <div class="container">
        <div class="first-page">
            <h1 class="company-first"><?php echo $key->getCompany() ?></h1>
            <div>
                <img class="logo" src="img.png" alt="logo">
            </div>
            <h1 class="company-first"><?php echo $key->getDepartment() ?></h1>
        </div>
        <div class="second-page">
            <div class="col">
                <div class="me">
                    <h1> <?php echo $key->getFullName()?> - <?php echo $key->getAge() ?> let </h1>
                    <h2> <?php echo $key->getMyJob() ?> </h2>
                </div>
            </div>
            <div class="col">
                <div class="info">
                    <p>Adresa: <?php echo $key->getAddress() ?>,</p>
                    <p> <?php echo $key->getCity() ?></p>
                    <p> Tel: <?php echo $key->getTel() ?></p>
                    <p> E-mail: <?php echo $key->getMail() ?></p>
                    <p> Web: <?php echo $key->getWeb() ?></p>
                    <p> <?php echo $key->getAvailable() ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
