<?php require './Person.php'; ?>
<?php

// this is a one-line comment

/*
this is a multiline
comment
*/


// variable declaration and initialization

$avatar = 'jedi-logo.svg';                  // data type string


$person0 = new Person('Anakin', 'Skywalker', 'Lead Developer / Architect', 'First Order Jedi Council', '+420 777 888 999',
'skywalker@jedi-council.com', 'www.jedi-council.com', true, 'Temple of Eedit', 42, 121, 'Coruscant', 1109435339);

$person1 = new Person('Jabba', 'the Hutt', 'Enjoyer of Life', 'Grand Hutt Council', '+420 123 456 789',
'jabba@hutt-council.com', 'www.hutt-council.com', false, 'Jabbas Palace', 100, 12, 'Tatooine', 60000000);

$person2 = new Person('Yoda', 'Yoda', 'Speaker of Wise Words', 'First Order Jedi Council', '+420 777 888 999',
'yoda@jedi-council.com', 'www.jedi-council.com', false, 'Temple of Eedit', 42, 121, 'Coruscant', 1);

$persons = [$person0, $person1, $person2];

?>

<?php include './includes/header.php'; ?>

    <?php foreach ($persons as $person) : ?>
        <?php include './includes/main.php'; ?>
    <?php endforeach ?>

<?php include './includes/footer.php'; ?>
    