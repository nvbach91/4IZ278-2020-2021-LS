<?php require './utils.php' ?>

<?php
$cities = [
    [
        'name' => 'Praha',
        'population' => 2500000,
    ], 
    [
        'name' => 'Brno',
        'population' => 100000,
    ], 
    [
        'name' => 'Londyn',
        'population' => 12000000, // 
    ], 
    [
        'name' => 'Moskva',
        'population' => 10500000,
    ], 
];
?>

<ul>
    <?php foreach($cities as $city): ?>
        <li>
            <div class="city-name">
                <?php echo $city['name']; ?>
            </div>
            <div class="city-population">
                <?php echo createShortNumber($city['population']); ?>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
