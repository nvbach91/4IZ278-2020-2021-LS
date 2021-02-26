<?php require './classes/City.php'; ?>
<?php 

$cities2 = [
    new City('Amsterdam', 500000, 5500),
    new City('Pariz', 4500000, 5560),
    new City('Oslo', 6500000, 7800),
    new City('Madrid', 12500000, 8900),
];

?>
<ul>
    <!-- for loop -->
    <?php foreach($cities2 as $city2): ?>
    <li>
        <div><?php echo $city2->name; ?></div>
        <div><?php echo shortenNumberByMilion($city2->population); ?></div>
        <div><?php echo $city2->area; ?></div>
        <div><?php echo $city2->getAreaInMeterSquare(); ?></div>
    </li>
    <?php endforeach; ?>
    <!-- for loop -->
</ul>