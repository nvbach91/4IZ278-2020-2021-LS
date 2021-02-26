<?php 
$cities = [
    [
        'name' => 'Praha',
        'population' => 2500000,
    ],
    [
        'name' => 'Brno',
        'population' => 1000000,
    ],
    [
        'name' => 'Londyn',
        'population' => 9000000,
    ],
    [
        'name' => 'Praha',
        'population' => 11000000,
    ],];
    ?>
<ul>
        <?php foreach($cities as $city): ?>
        <li><div><?php echo $city['name'];?></div>
            <div><?php echo createShortNumber($city['population']);?></div>
        </li>
        <?php endforeach; ?>
</ul>