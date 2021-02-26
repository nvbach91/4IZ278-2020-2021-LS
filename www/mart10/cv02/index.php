<?php require './classes/Person.php' ?>

<?php
$persons = [
    new Person('img/logo1.png','Marsik','Tad',new DateTime('1998/01/09'),'Cook','Ichiraku Ramen','Delicious St.',420,9,'Fukuoka','+420 776 123 456','ramen@ichiraku.jp','www.ichiraku-ramen.jp',true),
    new Person('img/logo2.png','Kriz','Jakub',new DateTime('1992/03/19'),'HR','Ichiraku Ramen','Delicious St.',420,9,'Fukuoka','+420 772 999 999','ramen@ichiraku.jp','www.ichiraku-ramen.jp',true),
    new Person('img/logo3.png','Omacka','Franta',new DateTime('1984/05/06'),'PR','Ichiraku Ramen','Delicious St.',420,9,'Fukuoka','+420 773 444 444','ramen@ichiraku.jp','www.ichiraku-ramen.jp',true),
    new Person('img/logo4.png','Masahi','Hasagi',new DateTime('1946/11/29'),'CEO','Ichiraku Ramen','Delicious St.',420,9,'Fukuoka','+420 774 666 666','ramen@ichiraku.jp','www.ichiraku-ramen.jp',true)
]

?>

<?php include './includes/header.php' ?>

<main class="container">
        <h1 class="text-center">My Business Card in PHP</h1>
        <?php foreach($persons as $person): ?>
        <div class="card front row">
            <div class="col-sm-4">
                <div class="logo" style="background-image: url(<?= $person->logo ?>)"></div>
            </div>
            <div class="col-sm-8">
                <div class="name"><?= $person->name ?></div>
                <div class="surname"><?= $person->surname ?></div>
                <hr/>
                <div class="occupation"><?= $person->occupation ?></div>
                <div class="company"><?= $person->company ?></div>
            </div>
        </div>
        <div class="card back row">
            <div class="col-sm-6">
                <div class="name"><?= $person->name ?></div>
                <div class="surname"><?= $person->surname ?></div>
                <div class="occupation"><?= $person->occupation ?></div>
                <div class="age"><?= $person->getAge() ?></div>
            </div>
            <div class="col-sm contacts">
                <div class="address"><i class="fas fa-map-marker-alt"></i> <?= $person->getAddress() ?></div>
                <div class="phone"><i class="fas fa-phone"></i> <?= $person->phone ?></div>
                <div class="email"><i class="fas fa-at"></i> <?= $person->email ?></div>
                <div class="website"><i class="fas fa-globe"></i> <?= $person->website ?></div>
                <div class="available"><?= $person->available ? 'Now available for contracts' : 'Not available for contracts'; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </main>
<?php include './includes/footer.php' ?>