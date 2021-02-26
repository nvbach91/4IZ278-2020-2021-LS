<?php include './includes/Person.php' ?>
<?php include './includes/header.php' ?>

<body>

    <?php foreach ($people as $person) : ?>
        <main class="container">
            <div class="row business-card front-side">
                <div class="col-sm-4">
                    <img src="img/logoLV_white.png" alt="logo" class="logo">
                </div>
                <div class="col-sm-8">
                    <div class="name">
                     <?php echo $person->getFullName(); ?>
                    </div>
                    <div class="position">Web Application Developer</div>
                </div>
            </div>
            <div class="row business-card back-side">
                <div class="col-sm-6">
                    <div class="name2">

                        <?php echo $person->getFullName(); ?>

                    </div>
                </div>
                <div class="col-sm-6">

                    <div class="address">
                    <i class="fas fa-user-clock"> <?php echo $person->getAge(); ?></i>
                    </div>
                    <div class="address">
                        <i class="fas fa-map-marker-alt"> <?php echo $person->getAddress(); ?></i>
                    </div>
                    <div class="phone">
                        <i class="fas fa-phone"><?php echo " $person->phone";?></i>
                    </div>
                    <div class="email">
                        <i class="fas fa-at"><?php echo " $person->email";?></i>
                    </div>
                    <div class="website">
                        <i class="fas fa-globe"><?php echo " $person->web";?></i>
                    </div>
                    <div class="available">
                        <?php echo $person->availableForOffers ? 'Avaiable for offers' : 'Not available for offers'; ?>
                    </div>
                </div>

            </div>
        </main>
    <?php endforeach; ?>

  <?php include './includes/footer.php';?>