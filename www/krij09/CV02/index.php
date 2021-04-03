<?php
require './classes/Person.php';

$persons = [
    new Person('images/logo.png','Ash','Ketchum',new DateTime('1998-04-28'),'Pokemon Trainer','Kanto s.r.o','Victory','105/12','PalletTown','+420 725 336 223','master.of.pokemon@gmail.com','https://pokemonrevolution.net/home',true),
    new Person('images/logo2.png','Megumin','Satou',new DateTime('2007-02-14'),'Arch Wizard','Adventure Guild','Fire','1713/14','Belzerg Kingdom','+420 604 420 693','chunchunmaru@gmail.com','https://chomusuke.net/home',true),
    new Person('images/logo3.png','Kazuto','Kirigaya',new DateTime('2008-10-07'),'Alpha Tester','Rath','Floor','17','Aincrad','+420 696 969 696','pussyslayer@gmail.com','https://kirito.net/home',false),
];

include './utils/header.php';
?>


		<main class="container text-center mt-5">
      <?php foreach ($persons as $person): ?>
        <div class="row mb-4">
			     <div class="card flex-md-row" style="width: 35rem">
				      <img class="mt-3 flex-auto ml-4 d-none d-lg-block mb-4" height="200px" src="<?=$person->logo;?>" alt="Card image cap">
            	<div class="card-body flex-column align-items-start mt-3 ">
              			<h3 class="mt-1 mb-0">
                			<p class="text-dark"><?= $person->getName(); ?></p>
              			</h3>
              		<div class="mb-1 text-muted"><?= $person->job;?></div>
              		<p class="card-text mb-auto"><?= date_format($person->dateOfBirth, 'Y-m-d'); ?> (<?= $person->getAge(); ?>)</p>
                  <p class="card-text mb-auto text-muted"><?= $person->company; ?></p>
            	</div>
          	</div>
          	<div class="card flex-md-row" style="width: 35rem">
            	<div class="card-body flex-column align-items-start">
              			<h3 class="mb-0">
                			<p class="text-dark"><?= $person->getName(); ?></p>
              			</h3>

              		<div class="mb-1 text-muted"><?= $person->job; ?></div>
              			<div class="row">
              				<p class="card-text col"><?= $person->getAddress(); ?></p>
              				<p class="card-text col"><?= $person->phone; ?></p>
              			</div>
              			<div class="row">
              				<p class="card-text col"><?= $person->email; ?></p>
              				<p class="card-text col"><?= $person->available ? 'Available for contracts' : 'Not available for contracts';?></p>
              			</div>
              		<p class="mt-1 mb-0"><?= $person->webpage; ?></p>
            	</div>
          	</div>
          </div>
    <?php endforeach; ?>
		</main>

<?php 
include './utils/footer.php';
?>