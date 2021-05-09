<?php

require 'config.php';

if (isset($_POST["action"])) {
	$query = "
	select
	drink_id as id,
	drink_name as name,
	CONCAT(TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from drink_vol)), 'l') as volume,
	price,
	alcoholic,
	inflammatory,
	deadly
	from drinks
	where drink_id IS NOT NULL
	";

	if (isset($_POST["alcoholic"])) {
		$query .= "
		AND alcoholic ";

		if ($_POST["alcoholic"]) {
			$query .= "= 1";
		} else {
			$query .= "!= 1";
		}
	}

	if (isset($_POST["deadly"])) {
		$query .= "
		AND deadly ";

		if ($_POST["deadly"]) {
			$query .= "= 1";
		} else {
			$query .= "!= 1";
		}
	}

	if (isset($_POST["inflammatory"])) {
		$query .= "
		AND inflammatory ";

		if ($_POST["inflammatory"]) {
			$query .= "= 1";
		} else {
			$query .= "!= 1";
		}
	}
	
	$variable["price"] = null;
	
	if (isset($_POST["price"])) {
		if ($_POST["price"] === "asc") {
			$query .= " order by price asc";
		} else if ($_POST["price"] === "desc") {
			$query .= " order by price desc";
		}
	} else {
		$query .= " order by drink_name asc";
	}
}


$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
$total_row = $statement->rowCount();
if ($_POST["shuffle"] && $total_row) {
	$drink = $result[array_rand($result)];
	$result = array();
	array_push($result, $drink);
}
if ($total_row) :

	foreach ($result as $drink) :
?>

		<div class="card
		<?= $drink['inflammatory'] ? "inflammatory" : "" ?>
		<?= $drink['deadly'] ? "deadly" : "" ?>">
			<div class="circle"></div>
			<div class="content">
				<h2><?= $drink['name'] ?><i class="fas fa-registered reg"></i></h2>
				<h3><?= $drink['volume'] ?></h3>
				<ul>
					<?php
					$query = "
						select CONCAT_WS(' ',
						CONCAT(TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from volume)), 'l'),
						IF(percentage, CONCAT(TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from percentage)), '%'), null),
						ingr_name) as ingredient
						from drinks_ingredients
						JOIN ingredients
							on ingredients.ingr_id = drinks_ingredients.ingr_id
						JOIN drinks
							on drinks.drink_id = drinks_ingredients.drink_id
						WHERE drinks_ingredients.drink_id = :drink_id";

					$statement = $connect->prepare($query);
					$statement->execute([':drink_id' => $drink['id']]);
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);
					foreach ($result as $row) :
					?>

						<li><?= $row['ingredient'] ?></li>

					<?php endforeach; ?>
				</ul>
				<div class="info">
					<div class="price_tag">
						<strong><?= $drink['price'] ?>&euro;</strong>
					</div>

					<?php if ($drink['inflammatory']) : ?>
						<i class="fas fa-fire"></i>
					<?php endif; ?>

					<?php if ($drink['deadly']) : ?>
						<i class="fas fa-skull-crossbones"></i>
					<?php endif; ?>

				</div>
			</div>
			<img src="img/drink.png" alt="Drink"> <!-- TODO: change /"drink".png for ?= strtolower preg_replace '/\s+/', '_', $drink'name'   ?> -->
		</div>

	<?php
	endforeach;
else :
	?>

	<h3>Žiadne výsledky</h3>

<?php
endif;

?>