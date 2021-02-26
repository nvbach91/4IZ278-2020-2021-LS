<?php require './classes/Person.php'?>
<?php require './utils.php'?>
<?php

$people = [ 
    new Person('jedi-logo.svg','Chris','Blazej','28.04.1990','Lead Developer / Architect','First Order Jedi Council','+420 777 888 999','skywalker@jedi-council.com','www.jedi-council.com',false,'Temple of Eedit',42, 121, 'Coruscant'),
    new Person('jedi-logo.svg','Mirek','Kraus','12.03.1999','CEO','First Order Jedi Council','+420 727 828 929','Mirek@jedi-council.co.uk','www.jedi-council.co.uk',false,'Jordana Jovkova',32, 121, 'Praha'),
    new Person('jedi-logo.svg','Petr','Šíma','12.03.1977','Student','Second Order Jedi Council','+420 711 998 229','Petr@jedi-council.cz','www.jedi-council.cz',false,'Ivana Sekaniny',1802, 11, 'Ostrava')
    ];
?>

<?php include './header.php' ?>
<?php include './main.php' ?>
<?php include './footer.php' ?>