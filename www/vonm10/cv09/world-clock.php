<?php

$prague = new DateTime("now", new DateTimeZone('Europe/Prague'));
$newYork = new DateTime("now", new DateTimeZone('America/New_York'));
$tokyo = new DateTime("now", new DateTimeZone('Asia/Tokyo'));
$kathmandu = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
$jamaica = new DateTime("now", new DateTimeZone('America/Jamaica'));

?>


<?php require __DIR__ . '/incl/header.php'; ?>
<h1>World Clock</h1>
<div>Prague: <?php echo $prague->format("H:i:s"); ?></div>
<div>New York: <?php echo $newYork->format("H:i:s"); ?></div>
<div>Tokyo: <?php echo $tokyo->format("H:i:s"); ?></div>
<div>Kathmandu: <?php echo $kathmandu->format("H:i:s"); ?></div>
<div>Jamaica: <?php echo $jamaica->format("H:i:s"); ?></div>
<?php require __DIR__ . '/incl/footer.php'; ?>