<?php
$dogs = [
    new Dog('Golden retriever','F',40,40),
    new Dog('German shepherd','M',30,60),
    new Dog('Husky','M',35,45),
    new Dog('Bulldog','M',20,20),
    new Dog('Poodle','F',25,50),
];

?>
<ul>
    <?php foreach($dogs as $dog): ?>
        <li>
            <div class="dog-type">
                <?php echo $dog->type;?>
            </div>
            <div class="dog-gender">
                <?php echo $dog->gender;?>
            </div>
            <div class="dog-weight">
                <?php echo $dog->weight;?>
            </div>
            <div class="dog-height">
                <?php echo $dog->height;?>
            </div>
            <div class="dog-dimension">
                <?php echo $dog->getDimension();?>
            </div>
        </li>
    <?php endforeach;?>
  </ul>