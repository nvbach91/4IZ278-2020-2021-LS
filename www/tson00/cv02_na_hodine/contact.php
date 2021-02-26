<?php include './includes/header.php'?>
  <h1>Ahoj</h1>
  <ul>
    <?php foreach($cities as $city): ?>
        <li>
            <div><?php echo $city['name'];?></div>
           <div><?php echo createShortNumber($city['population']);?></div>
        </li>
    <?php endforeach;?>
  </ul>
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
<?php include './includes/footer.php'?>
