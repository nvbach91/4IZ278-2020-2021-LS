<?php include './includes/header.php'?>
<body>
    <h1>Ahooj</h1>
    <h2><?php echo createShortNumber(1000000); ?>
        <ul>
            <?php foreach($cities as $city): ?>    
                <li>
                    <div class="city-name"><?php echo $city['name'];?></div>
                    <div class="city-population"><?php echo createShortNumber($city['population']);?></div>
                </li>
            <?php endforeach; ?>
        </ul>
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
<?php include './includes/footer.php'?>