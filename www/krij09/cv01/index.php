<?php

$logo = 'logo.png';
$name = 'Ash';
$surname = 'Ketchum';
$job = 'Pokemon Trainer';
$firmName = 'Kanto s.r.o';
$street = 'Victory';
$number = '105/2';
$city = 'PalletTown';
$phone = '+420 725 336 223';
$email = 'master.of.pokemon@gmail.com';
$webpage = 'https://pokemonrevolution.net/home';
$available = false;

$address = "$street $number, $city";

$dateOfBirth = '1998-04-28';
$dateTime = new DateTime($dateOfBirth);
$now = new DateTime('today');
$difference = $dateTime->diff($now);
$age = $difference->y;

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Title of the document</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</head>
	<style>
		.card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
}
	</style>
	<body>
		<div class="container text-center mt-5">
			<div class="card flex-md-row shadow-sm h-md-250 mb-5 border border-3" style="width: 30rem">
				<img class="mt-3 card-img-right flex-auto d-none d-lg-block mb-4" height="200px" src="<?=$logo;?>" alt="Card image cap">
            	<div class="card-body d-flex flex-column align-items-start mt-3 ">
              			<h3 class="mt-1 mb-0">
                			<p class="text-dark"><?=$name;?> <?=$surname;?></p>
              			</h3>
              		<div class="mb-1 text-muted"><?=$job;?></div>
              		<p class="card-text mb-auto"><?=$dateOfBirth;?> (<?=$age;?>)</p>
            	</div>
          	</div>

          	<div class="card flex-md-row shadow-sm h-md-250 border border-3" style="width: 30rem">
            	<div class="card-body d-flex flex-column align-items-start">
              			<h3 class="mb-0">
                			<p class="text-dark"><?=$name;?> <?=$surname;?></p>
              			</h3>

              		<div class="mb-1 text-muted"><?=$job;?></div>
              			<div class="row">
              				<p class="card-text col"><?=$address;?></p>
              				<p class="card-text col"><?=$phone;?></p>
              			</div>
              			<div class="row">
              				<p class="card-text col"><?=$email;?></p>
              				<p class="card-text col"><?=$available ? 'Not available for contracts' : 'Available for contracts';?></p>
              			</div>
              		<p class="mt-1 mb-0"><?=$webpage;?></p>
            	</div>
          	</div>
		</div>
	</body>
</html>
