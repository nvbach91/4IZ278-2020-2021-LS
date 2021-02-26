<?php foreach($persons as $person) : ?>
        <div id="container">
        
        <div id="front" class="card">
            <img src="<?php echo "./logos/$person->logoPath"; ?>" alt="logo" height="80">

        </div>
        <div id="back" class="card">
            <div class="side">
                <p class="name"><?php echo $person->name; ?></p>
                <p><?php echo $person->concatenateAddress(); ?></p>
                <p>Tel: <?php echo $person->phone; ?></p>
                <p>E-mail: <?php echo $person->mail; ?></p>
            </div>
            <div class="side">

                <p>Narození: <?php echo $person->getBirthDateFormatted(); ?></p>
                <p>Věk: <?php echo $person->getAge(); ?></p>
                <p><?php echo $person->company; ?></p>
                <p><?php echo $person->web; ?></p>
                <p><?php echo $person->isAvailable; ?></p>

            </div>
        </div>
    </div>
    <?php endforeach; ?>