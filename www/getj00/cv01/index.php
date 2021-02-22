<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Getman Systems, s.r.o.</title>

	<style>
		body {
			background-color: #333333;
			color: #bbbbbb;
		}

		h1 {
  			color: #ffbb77;
  			margin-left: 120px;
		}
		a {
			color: #77bbff;
		}
	</style>

	</head>
	<body>

	<?php
	$companyname='Getman Systems, s.r.o.';
	$degbefore = 'HaDr.';
	$name = 'Johannes';
	$surname = 'Getmann';
	$degafter = "BSE";
	$founded = '2014';
	$year = "2020"; // TODO some function for getting current year
	$slogan = "the weirdest software on the planet, both free and paid.";
	/*
	$people = [
		'name' => $name,
		'age' => $age
	];
	$fruits = ['banana', 'tomato', 'melon'];
	$abbys = null;
	 */

	$street = 'Konopna';
	$number = '420/69';
	$city = 'Pragl';
	$country = 'Cajzlistan';

	//$address2 = $street . ' ' . $number . ', ' . $city;
	//$address = "$street $number, $city";
	//echo $address;
	
	$phone = "+420 123 456 789";
	$email = "getj00 (a) vse *dot* cz";
	$webaddr = "https://getmania.blogspot.com";
	$acceptingjobs = false;
	?>

	<p>

	<?php
	echo "<h1>$companyname</h1>";

	echo $year - $founded;
	echo " years of $slogan<br><br>";

	echo "$degbefore $name $surname, $degafter<br>";
	echo "$street $number<br>";
	echo "$city, $country<br><br>";

	echo "Telephone: $phone<br>";
	echo "E-mail: $email<br>";
	echo "Webpage: <a href=\"$webaddr\">$webaddr</a><br><br>";

	if($acceptingjobs){
		echo 'I am welcome to accepting jobs.<br>';
	}else{
		echo 'Jobs aren\'t being accepted at this time.<br>';
	}

	?>

	</p>
	</body>
</html>
