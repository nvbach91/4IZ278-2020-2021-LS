<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="card" style="width: 18rem;">

  <img src="<?= $spdetail["img"] ?>" class="card-img-top">

  <div class="card-body">

    <h5 class="card-title">{{ $spdetail["name"] }}</h5>

    <p class="card-text">{{ $spdetail["gps"] }}</p>

  </div>

</div>
</body>
</html>