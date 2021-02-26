<?php require './classes/Dog.php' ?>
<?php


$dogs = [
    new Dog('Golden retriever', 'F', 40, 40),
    new Dog('German shepherd', 'M', 30, 60),
    new Dog('Husky', 'M', 35, 45),
    new Dog('Bulldog', 'M', 20, 20),
    new Dog('Poodle', 'F', 25, 50),
];

?>

<ul>
    <?php foreach($dogs as $dog): ?>
        <li>
            <div class="dog-type">
                <?php echo $dog->type; ?>
            </div>
            <div class="dog-gender">
                <?php echo $dog->gender; ?>
            </div>
            <div class="dog-dimensions">
                <?php echo $dog->getDimensions(); ?>
            </div>
        </li>
    <?php endforeach; ?>
</ul>