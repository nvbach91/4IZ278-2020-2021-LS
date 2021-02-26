<?php require './classes/Dog.php'?>

<?php 

$dogs = [
    new Dog('Golden Retriever', 'F', 20, 40),
    new Dog('German Dog', 'M', 40, 45),
    new Dog('Husky', 'M', 50, 40),
    new Dog('Bulldog', 'F', 5, 10),
];

?>


<ul>
    <?php foreach($dogs as $dog): ?>    
        <li>
                    <div class="dog-name">
                        <?php echo $dog->type;?>
                    </div>
                    <div class="dog-gender">
                        <?php echo $dog->gender;?>
                    </div>
                    <div class="dog-dimensions">
                        <?php echo $dog->getDimensions();?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>