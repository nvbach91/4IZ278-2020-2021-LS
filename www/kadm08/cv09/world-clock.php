<?php

$currentDate = new DateTime("now", new DateTimeZone('Europe/Prague'));

$dates  = array(
    array( 
        'timezone' => 'Prague',
        'dateTime' => new DateTime("now", new DateTimeZone('Europe/Prague')),
        'format' => 'd.m.Y H:m:s',
        'difference' => 0

    ),
    array( 
        'timezone' => 'London',
        'dateTime' => new DateTime("now", new DateTimeZone('Europe/London')),
        'format' => 'd/m/Y g:i A',
        'difference' => timezone_offset_get(timezone_open('Europe/London'), $currentDate)/3600
    ),
    array( 
        'timezone' => 'Los Angeles',
        'dateTime' => new DateTime("now", new DateTimeZone('America/Los_Angeles')),
        'format' => 'm/d/Y g:i A',
        'difference' => timezone_offset_get(timezone_open('America/Los_Angeles'), $currentDate)/3600
    ),
    array( 
        'timezone' => 'Bangkok',
        'dateTime' => new DateTime("now", new DateTimeZone('Asia/Bangkok')),
        'format' => 'd/m/Y H:m:s',
        'difference' => timezone_offset_get(timezone_open('Asia/Bangkok'), $currentDate)/3600
    ),
    array( 
        'timezone' => 'Sydney',
        'dateTime' => new DateTime("now", new DateTimeZone('Australia/Sydney')),
        'format' => 'm d, Y g:i A',
        'difference' => timezone_offset_get(timezone_open('Australia/Sydney'), $currentDate)/3600
    )
)

?>

<?php require __DIR__ . '/includes/header.php'; ?>

<main class="container">
    <?php foreach($dates as $date): ?>
        <div class="row">
            <div class="col-md">
            <div><?php echo $date['timezone']; ?></div>
            </div>
            <div class="col-md">
            <div class="text-center text-info">
                <?php echo $date['dateTime']->format($date['format']); ?>
                <?php echo isset($date['difference']) ? '( ' . $date['difference'] . 'h )' : ''; ?> 
            </div>
            </div>
        </div>
    <?php endforeach; ?>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>

