<?php
    session_start();
    require __DIR__ . '/includes/header.php';

    function getTimeZoneDifference($timezone) {
        $defaultDate = new DateTime("now", new DateTimeZone('Europe/Prague'));
        $difference = timezone_offset_get(timezone_open($timezone), $defaultDate)/3600;
        return $difference < 0 ? '' . $difference : '+' . $difference;
    }

    $dates = [
        [
            'city' => 'Praha',
            'date' => new DateTime("now", new DateTimeZone('Europe/Prague')),
            'format' => 'j. n. Y ---- H:m:s'
        ], [
            'city' => 'New York',
            'date' => new DateTime("now", new DateTimeZone('America/New_York')),
            'format' => 'm/d/Y ---- g:m:s a',
            'diff' => getTimeZoneDifference('America/New_York')
        ], [
            'city' => 'Tokyo',
            'date' => new DateTime("now", new DateTimeZone('Asia/Tokyo')),
            'format' => 'Y年m月d日 ---- H:m:s',
            'diff' => getTimeZoneDifference('Asia/Tokyo')
        ], [
            'city' => 'Los Angeles',
            'date' => new DateTime("now", new DateTimeZone('America/Los_Angeles')),
            'format' => 'm/d/Y ---- g:m:s a',
            'diff' => getTimeZoneDifference('America/Los_Angeles')
        ], [
            'city' => 'Jeruzalém',
            'date' => new DateTime("now", new DateTimeZone('Asia/Jerusalem')),
            'format' => "d. m. Y ---- H:m:s",
            'diff' => getTimeZoneDifference('Asia/Jerusalem')
        ]
    ];
?>

<main class="container">
    <h1 class="text-center">World clocks</h1>
    <?php foreach($dates as $date): ?>
        <div class="mb-3 col-md-8 bg-dark" style="font-size: 2em;">
            <div><?php echo $date['city']; ?></div>
            <hr class="mt-0 mb-0 bg-white">
            <div class="text-center text-warning">
                <?php echo $date['date']->format($date['format']); ?>
                <?php echo isset($date['diff']) ? '( ' . $date['diff'] . 'h )' : ''; ?> 
            </div>
        </div>
    <?php endforeach; ?>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>