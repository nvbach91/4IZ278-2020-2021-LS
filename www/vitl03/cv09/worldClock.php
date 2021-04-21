<?php

session_start();

$prague = new DateTime("now", new DateTimeZone('Europe/Prague'));
$newYork = new DateTime("now", new DateTimeZone('America/New_York'));
$tokyo = new DateTime("now", new DateTimeZone('Asia/Tokyo'));
$shanghai = new DateTime("now", new DateTimeZone('Asia/Shanghai'));
$singapore = new DateTime("now", new DateTimeZone('Asia/Singapore'));
$jamaica = new DateTime("now", new DateTimeZone('America/Jamaica'));




?>

<?php include __DIR__ . '/includes/header.php' ?>
<?php require __DIR__ . '/includes/navigation.php'; ?>

<body>
<br>
    <div class="container">
        <h1>World Clock</h1>
        <div>Prague: <?php echo $prague->format("H:i:s"); ?></div>
        <div>New York: <?php echo $newYork->format("H:i:s"); ?></div>
        <div>Tokyo: <?php echo $tokyo->format("H:i:s"); ?></div>
        <div>Shanghai: <?php echo $shanghai->format("H:i:s"); ?></div>
        <div>Singapore: <?php echo $singapore->format("H:i:s"); ?></div>
    </div>
    <div style="margin-bottom: 600px"></div>
    <?php include __DIR__ . '/includes/footer.php' ?>