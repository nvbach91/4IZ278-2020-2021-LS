<?php require './header.php'; ?>
<?php //require './hotreloader.php'; ?>

<div class="container">
    <h1 class="text-center">My business card</h1>
    <?php foreach($people as $person) { ?>
    <div class="business-card business-card__front row">
        <div class="col-sm-4">
            <img class="bc-logo" src="./img/<?php echo $person->getLogo()?>" alt="logo">
        </div>
        <div class="col-sm-8">
            <div class="bc-firstname"><?php echo $person->getName(); ?></div>
            <div class="bc-surname"><?php echo $person->getSurName(); ?></div>
            <div class="bc-position"><?php echo $person->getPosition(); ?></div>
            <div class="bc-company"><?php echo $person->getCompanyName(); ?></div>
        </div>
    </div>
    <div class="business-card business-card__back row">
        <div class="col-sm-6">
            <div class="bc-firstname"><?php echo $person->getName(); ?></div>
            <div class="bc-surname"><?php echo $person->getSurName(); ?></div>
            <div class="bc-title"><?php echo $person->getPosition() ?></div>
            <div class="bc-age"><?php echo $person->getAge(); ?> let</div>
        </div>
        <div class="col-sm-6 contacts">
            <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $person->getAddress(); ?></div>
            <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $person->getPhoneNumber(); ?></div>
            <div class="bc-email"><i class="fas fa-at"></i> <?php echo $person->getEmail(); ?></div>
            <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $person->getCompanyWeb(); ?></div>
            <div class="bc-available"><?php echo $person->getAvailable(); ?></div>
        </div>
    </div>
    <?php } ?>

<?php require './footer.php'; ?>
