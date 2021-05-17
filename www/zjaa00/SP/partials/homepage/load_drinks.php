<?php

require_once '../../_inc/config.php';

if (isset($_POST["action"])) {
	$query = "
		select
		drink_id as drink_id,
		name as drink_name,
		volume as drink_volume,
		image,
		price,
		alcoholic,
		inflammatory,
		deadly,
		available
		from drinks
		where drink_id IS NOT NULL
	";

	if (authorize(1)) {
		$query .= "
		AND available = 1";
	}
	
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
	
	if (isset($_POST["price"])) {
		if ($_POST["price"] === "asc") {
			$query .= "
			order by price asc";
		} else if ($_POST["price"] === "desc") {
			$query .= "
			order by price desc";
		}
	} else {
		$query .= "
		order by drink_name asc";
	}
}

//získame všetky drinky a zistíme, či nejaké vôbec existujú
$stmt = $connect->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();
$total_row = $stmt->rowCount();

if ($total_row):
	//shuffle
	if ($_POST["shuffle"]) {
		$drink = $result[array_rand($result)];
		$result = array();
		array_push($result, $drink);
	}

	foreach ($result as $drink): ?>

		<div
		unselectable="on"
		onselectstart="return false;" 
		onmousedown="return false;"
		class="card
		<?= $drink['inflammatory'] ? "inflammatory" : "" ?>
		<?= $drink['deadly'] ? "deadly" : "" ?>"
		id="drink-<?= $drink['drink_id'] ?>">
			<div class="circle"></div>
			<div class="content">
				<h2><?= $drink['drink_name'] ?><i class="fas fa-registered reg"></i></h2>
				<h3><?= $drink['drink_volume'] ?>l</h3>
				<ul>
					<?php
					//vyberieme si ingrediencie daného drinku
					$query = "
						select CONCAT_WS(' ',
						CONCAT(TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from drinks_ingredients.volume)), 'l'),
						IF(percentage, CONCAT(TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from percentage)), '%'), null),
						ingredients.name) as ingredient
						from drinks_ingredients
						JOIN ingredients
							on ingredients.ingr_id = drinks_ingredients.ingr_id
						JOIN drinks
							on drinks.drink_id = drinks_ingredients.drink_id
						WHERE drinks_ingredients.drink_id = :drink_id
					";
					$stmt = $connect->prepare($query);
					$stmt->execute([':drink_id' => $drink['drink_id']]);
					$result = $stmt->fetchAll();
					foreach ($result as $row): ?>

						<li><?= $row['ingredient'] ?></li>

					<?php endforeach; ?>
				</ul>
				<div class="info">
					<div class="price_tag">
						<strong><span><?= $drink['price'] ?></span>&euro;</strong>
					</div>

					<!-- pridáme na kartičku značky -->
					<?php if ($drink['inflammatory']): ?>
						<i class="fas fa-fire"></i>
					<?php endif; ?>

					<?php if ($drink['deadly']) : ?>
						<i class="fas fa-skull-crossbones"></i>
					<?php endif; ?>

				</div>
				<?php if(authorize(2)): ?>
					<div class="manager_tools">
						<a class="btn btn-light" href="edit_item.php?drink_id=<?= $drink['drink_id'] ?>">Upraviť</a>
						<a class="btn btn-danger" href="./manipulate_item.php?drink_id=<?= $drink['drink_id'] ?>">Vymazať</a>
					</div>
				<?php endif; ?>
			</div>

			<div class="img" style="background-image: url('img/items/<?= $drink['image'] ?>');"></div>

			<!-- ak sme užívateľ, tak si vieme načítať zo SESSION objednávku a počty jednotlivých drinkov dať na ich kartičky -->
			<?php if (authorize(1)):
				@$drink_amount = $_SESSION['order'][$drink['drink_id']]['amount'];
			?>
				<div class="add"><div style="<?= @$drink_amount ? "" : "display: none;" ?>"><?= @$drink_amount ? $drink_amount : "" ?></div></div>
			<?php endif; ?>

			<!-- pokiaľ sme admin, tak sa nám ukážu aj drinky, ktoré už nie sú k dispozícií (viz. riadok 25) --> 
			<?php if(authorize(2) && !$drink['available']): ?>
				<div class="unavailable">
					<h2>Nepredáva sa</h2>
					<a class="btn btn-light" href="./manipulate_item.php?drink_id=<?= $drink['drink_id'] ?>&available=1">Obnoviť drink</a>
				</div>
			<?php endif; ?>
		</div>
	<?php
	endforeach;

else: ?>

	<h3>Žiadne výsledky</h3>

<?php endif; ?>