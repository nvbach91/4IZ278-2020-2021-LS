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

<img src="<?= $data["info"]["img"] ?>" class="card-img-top">

<div class="card-body">

  <h5 class="card-title">{{ $data["info"]["name"] }}</h5>

  <p class="card-text">{{ $data["info"]["size"] }}</p>

</div>

<ul class="list-group list-group-flush">

  @foreach($data["stations"] as $station)

    <li class="list-group-item"><a href="./spacestationdetail">{{ $station }}</a></li>

  @endforeach

</ul>

</div>
</body>
</html>