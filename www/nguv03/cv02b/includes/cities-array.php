
<?php require './utils.php'; ?>
<?php 

$cities = [
    [
        'name' => 'Praha',
        'population' => 2500000,
    ],
    [
        'name' => 'New York',
        'population' => 22500000,
    ],
    [
        'name' => 'Tokyo',
        'population' => 32000000,
    ],
    [
        'name' => 'Brno',
        'population' => 1000000,
    ],
];

?>
<ul>
    <!-- for loop -->
    <?php foreach($cities as $city): ?>
    <li>
        <div><?php echo $city['name']; ?></div>
        <div><?php echo shortenNumberByMilion($city['population']); ?></div>
    </li>
    <?php endforeach; ?>
    <!-- for loop -->
</ul>