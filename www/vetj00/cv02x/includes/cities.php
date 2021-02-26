<?php require './utils.php'?>
<?php 

$cities = [
    [
        'name' => 'Praha',
        'population' => 25000000,
    ],
    [
        'name' => 'Bratislava',
        'population' => 1651000,
    ],
    [
        'name' => 'Londyn',
        'population' => 24650000,
    ],
    [
        'name' => 'Moskva',
        'population' => 32100000,
    ],
];

?>

<ul>
    <?php foreach($cities as $city): ?>    
                <li>
                    <div class="city-name"><?php echo $city['name'];?></div>
                    <div class="city-population"><?php echo createShortNumber($city['population']);?></div>
                </li>
            <?php endforeach; ?>
    </ul>