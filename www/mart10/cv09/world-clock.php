<?php
  function getTimeDifference($timezone) {
    $main_date = new DateTime("now", new DateTimeZone('Europe/Prague'));
    $difference = timezone_offset_get(timezone_open($timezone), $main_date)/3600;
    return $difference < 0 ? '' . $difference : '+' . $difference;
  }


  $times = [
    [
      'city' => 'Praha',
      'date' => new DateTime("now", new DateTimeZone('Europe/Prague')),
      'format' => 'j. n. Y, H:m:s'
    ],
    [
    'city' => 'Tokyo',
    'date' => new DateTime("now", new DateTimeZone('Asia/Tokyo')),
    'format' => 'Y年m月d日 ---- H:m:s',
    'diff' => getTimeDifference('Asia/Tokyo')
    ],
    [
      'city' => 'New York',
      'date' => new DateTime("now", new DateTimeZone('America/New_York')),
      'format' => 'm/d/Y, h:i:s a',
      'diff' => getTimeDifference('America/New_York')
    ],
    [
        'city' => 'Los Angeles',
        'date' => new DateTime("now", new DateTimeZone('America/Los_Angeles')),
        'format' => 'm/d/Y ---- g:m:s a',
        'diff' => getTimeDifference('America/Los_Angeles')
    ],
    [
      'city' => 'London',
      'date' => new DateTime("now", new DateTimeZone('Europe/London')),
      'format' => 'd.m.Y, h:i:s a',
      'diff' => getTimeDifference('Europe/London')
    ]
  ];
  ?>

<?php require './incl/header.php'; ?>
<div class="main">
  <div class="row">
    <div class="col text-center">
        <?php foreach($times as $time): ?>
            <div class="card" style="width: 18rem; margin-bottom: 10px;">
                <div class="card-header">
                <?= $time['city']; ?>
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item"><?= $time['date']->format($time['format']); ?></li>
                <?php if(isset($time['diff'])): ?>
                <li class="list-group-item"><?= $time['diff'] ?>h</li>
                <?php endif; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
  </div>
</div>
<?php require './incl/footer.php'; ?>