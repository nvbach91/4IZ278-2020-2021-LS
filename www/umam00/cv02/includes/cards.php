<h1 class="text-center">My Business Card in PHP</h1>
<?php 
$people = [
    new Person('01.svg', 'Maga','Umachanov', 'Bc.', 'FTRS', '555 152', 'maga@email.com', 'umachanov.com', false, 'hlavní','1','111 00', 'Prague'),
    new Person('01.svg', 'Agam','Vonahcamu', 'Ing.', 'Google', '555 422', 'Agam@email.com', 'Agam.com', false, 'Vedlejší','2','211 00', 'Brno'),
    new Person('01.svg', 'Gama','Chanovuma', 'Phd.', 'Microsoft', '555 892', 'gama@email.com', 'gama.com', true, 'Třetí','4','231 00', 'Moscow'),
    new Person('01.svg', 'Josef','Popovič', 'Mgr.', 'Avas', '555 022', 'JP@email.com', 'JP.com', true, 'Sekeřická','12','101 00', 'Most'),
    ];
    
foreach($people as $person): ?>
    <main class="container p-5">
        <div class="business-card bc-front row">
            <div class="col-sm-4">
                <div class="logo" style="background-image: url(./img/<?php echo  $person->avatar; ?>)"></div>
            </div>
            <div class="col-sm-8">
                <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                <div class="bc-title"><?php echo $person->title; ?></div>
                <div class="bc-company"><?php echo $person->company; ?></div>
            </div>
        </div>
        <div class="business-card bc-back row">
            <div class="col-sm-6">
                <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                <div class="bc-title"><?php echo $person->title; ?></div>
            </div>
            <div class="col-sm-6 contacts">
                <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo shortAddress($person->street, $person->propertyNumber, $person->orientationNumber, $person->city) ?></div>
                <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $person->phone; ?></div>
                <div class="bc-email"><i class="fas fa-at"></i> <?php echo $person->email; ?></div>
                <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $person->website; ?></div>
                <div class="bc-available"><?php echo $person->available ? 'Not available for contracts' : 'Now available for contracts'; ?></div>
            </div>
        </div>
    </main>
    <hr>
<?php endforeach; ?>