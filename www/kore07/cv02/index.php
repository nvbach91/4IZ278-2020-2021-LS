<?php require './Person.php' ?>
<?php

$persons = [
    new Person("Kortoshkina", "Katerina", 1997, "student", "VSE", "nám. W. Churchilla", 1938, 4, "Praha", "778888999", "ekortoshkina@seznam.cz", "www.web.cz", true, "https://upload.wikimedia.org/wikipedia/commons/1/1e/RPC-JP_Logo.png"),
    new Person("Pelevin", "Nikita", 1995, "student", "VSCHT", "Technicka", 24, 5, "Praha", "999555666", "npelevin@seznam.cz", "www.business.cz", true, "https://upload.wikimedia.org/wikipedia/commons/1/1e/RPC-JP_Logo.png"),
    new Person("Krivda", "Martin", 1999, "student", "CVUT", "Technicka", 21, 5, "Praha", "111444878", "mkrivda@seznam.cz", "www.bus.cz", true, "https://upload.wikimedia.org/wikipedia/commons/1/1e/RPC-JP_Logo.png"),
];

?>

<?php include './includes/header.php' ?>
    <main class="main">
        <?php foreach($persons as $person): ?>
            <div class="business-card">
                <div class="front wrapper">
                    <div class="front__logo">
                        <img src="<?php echo $person->logoUrl; ?>" width="60" heigth="60" alt="Logo">
                    </div>
                    <div class="container">
                        <p class="front__name text"><?php echo $person->getFullName(); ?></p>
                        <p class="front__work text"><?php echo $person->position; ?></p> 
                        <span class="front__age text"><?php echo $person->getAge(); ?></span>
                    </div>
                </div>
                <div class="back wrapper">
                    <p class="back__address text"><?php echo $person->workplace . ': ' . $person->getAddress(); ?></p>
                    <p class="back__phone text"><?php echo $person->phone; ?></p>
                    <p class="back__email text"><?php echo $person->email; ?></p>
                    <p class="back__web text"><?php echo $person->web; ?></p>
                    <p class="back__availability text"><?php echo $person->getAvailability(); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </main>

<?php include './includes/footer.php' ?>