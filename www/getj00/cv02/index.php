
<?php require 'businessCard.php'; ?>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Business Cards</title>

	<link rel="stylesheet" type="text/css" href="style.css" />

	</head>
	<body>


	<p>

<?php
	foreach($businessCards as $bc):
		echo '<div class="cardBorder">';		
		echo '<h1>' . $bc->getCompanyName() . '</h1>';

		echo '<i>' . $bc->getSlogan() . '</i><br><br>';

		echo $bc->getFullName() . '<br>';
		echo $bc->getStreetNumber() . '<br>';
		echo $bc->getZipCity() . '<br>';
		echo $bc->getCountry() . '<br><br>';

		echo 'Telephone: ' . $bc->getPhone() . '<br>';
		echo 'E-mail: ' . $bc->getEmail() . '<br>';
		echo 'Webpage: <a href="' . $bc->getWebURL() . '">' 
				. $bc->getWebURL() . '</a><br><br>';
		echo '</div>';

		echo '<br><br>';
	endforeach;
?>

	</p>
	</body>
</html>


