<?php require './classes/Dog.php' ?>

<?php

$dogs = [
    new Dog('Akita Inu', 'F', 20, 40),
    new Dog('Husky', 'F', 20, 40),
    new Dog('Bígl', 'M', 20, 40),
    new Dog('Buildog', 'M', 20, 40)
]
?>

<ul>
        <?php foreach ($dogs as $d) : ?>
            <li>
                <div class="dog-name">
                    <?php echo $d->type; ?>
                </div>
                <div class="dog-name">
                    <?php echo $d->gender; ?>
                </div>
                <div class="dog-name">
                    <?php echo $d->weight; ?>
                </div>
                <div class="dog-name">
                    <?php echo $d->getDimensions(); ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>