<?php 

$cities = [
    [
        'name' => 'Praha',
        'population' => 2500000
    ],
    [
        'name' => 'Brno',
        'population' => 100000
    ],
    [
        'name' => 'Londyn',
        'population' => 12000000
    ],
    [
        'name' => 'Moskva',
        'population' => 10500000
    ],
];


?>

<ul>
        <?php foreach ($cities as $c) : ?>
            <li>
                <div class="dog-name">
                    <?php echo $c['name']; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>