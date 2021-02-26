<?php 


$dogs = [
    new Dog('Chau Chau', 'M', 20, 40),
    new Dog('Golder Retriever', 'F', 30, 35),
    new Dog('Shepherd', 'M', 25, 45),
    new Dog('Husky', 'F', 27, 50),
    new Dog('Bulldog', 'M', 30, 50),
    ];
    
?>



<ul>
        <?php foreach($dogs as $dog): ?>
            <li><div><?php echo $dog->type;?></div>
            <li><div><?php echo $dog->gender;?></div>
            <li><div><?php echo $dog->getDimension();?></div>
        </li>
        <?php endforeach; ?>
    </ul>