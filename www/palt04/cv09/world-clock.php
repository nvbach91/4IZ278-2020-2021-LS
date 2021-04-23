<?php

    require './user-required.php';
  require './includes/header.php';

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
      'city' => 'Moscow',
      'date' => new DateTime("now", new DateTimeZone('Europe/Moscow')),
      'format' => 'd.m.Y, H:i:s',
      'diff' => getTimeDifference('Europe/Moscow')
    ],
    [
      'city' => 'New York',
      'date' => new DateTime("now", new DateTimeZone('America/New_York')),
      'format' => 'm/d/Y, h:i:s a',
      'diff' => getTimeDifference('America/New_York')
    ],
    [
      'city' => 'London',
      'date' => new DateTime("now", new DateTimeZone('Europe/London')),
      'format' => 'd.m.Y, h:i:s a',
      'diff' => getTimeDifference('Europe/London')
    ],
    [
      'city' => 'Paris',
      'date' => new DateTime("now", new DateTimeZone('Europe/Paris')),
      'format' => "Y. m. d, h:i:s a",
      'diff' => getTimeDifference('Europe/Paris')
      ]
  ];
  ?>

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


  <?php require './includes/footer.php'; ?>