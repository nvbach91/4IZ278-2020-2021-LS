<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GX in space</title>
</head>
<body>
<div class="card" style="width: 18rem;">
    <div class="card-header">
      Galaxies
    </div>
    <ul class="list-group list-group-flush">
      @foreach($galaxies as $galaxy)
        <li class="list-group-item"><a href="./galaxies/<?= $galaxy["id"] ?>">{{ $galaxy->name }}</a></li>
      @endforeach
    </ul>
  </div>
</body>
</html>