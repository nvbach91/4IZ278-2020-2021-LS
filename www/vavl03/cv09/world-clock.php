<?php

$prague = new DateTime("now", new DateTimeZone('Europe/Prague'));
$newYork = new DateTime("now", new DateTimeZone('America/New_York'));
$amsterdam = new DateTime("now", new DateTimeZone('Europe/Amsterdam'));
$bissau = new DateTime("now", new DateTimeZone('Africa/Bissau'));
$tahiti = new DateTime("now", new DateTimeZone('Pacific/Tahiti'));

?>
<h1>World Clock</h1>
<div>Prague: <?php echo $prague->format("H:i:s"); ?></div>
<div>New York: <?php echo $newYork->format("H:i:s"); ?></div>
<div>Amsterdam: <?php echo $amsterdam->format("H:i:s"); ?></div>
<div>Bissau: <?php echo $bissau->format("H:i:s"); ?></div>
<div>Tahiti: <?php echo $tahiti->format("H:i:s"); ?></div>
