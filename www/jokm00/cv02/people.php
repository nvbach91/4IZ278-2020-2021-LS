<?php require "./classes/Person.php"?>
<?php
$joe = new Person("joe.svg","Joe","Biden","20.11.1942","CEO of US","Democratic Party","123 465 789","joe@whitehouse.gov","joe.gov","Pennsylvania Ave","1600","Washington DC","20500");
$people = [
    $joe,
    new Person("joe.svg","Kamala","Harris","20.10.1964", "VicePresident of US","Democratic Party","123 465 788","kam@whitehouse.gov","kamala.gov","Pennsylvania Ave","1600","Washington DC","20500"),
    new Person("joe.svg","Jill","Biden","03.06.1951","First lady","Democratic Party","123 465 787","jill@whitehouse.gov","jill.com","Pennsylvania Ave","1600","Washington DC","20500")
]
?>

<main class="container">
        
        <?php foreach($people as $person): ?>
            <div class="row">
                <div class="business-card front">
                    <div class="col-logo">
                        <div class="logo" style="background-image: url(./img/<?php echo $person->logo; ?>)"></div>
                    </div>
                    <div class="col-sm-8">
                        <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                        <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                        <div class="bc-title"><?php echo $person->title; ?></div>
                        <div class="bc-company"><?php echo $person->company; ?></div>
                    </div>
                </div>
                <div class="business-card back">
                    <div class="col-sm-6 contacts">
                        <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $person->getAdress(); ?></div>
                        <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $person->phone; ?></div>
                        <div class="bc-email"><i class="fas fa-at"></i> <?php echo $person->email; ?></div>
                        <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $person->website; ?></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                        <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                        <div class="bc-title"><?php echo $person->title ?></div>
                        <div class="bc-age"><?php echo $person->getAge() ?> years old</div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </main>