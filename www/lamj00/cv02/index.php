<?php require './classes/Person.php'; ?>

<?php
$people = [
    new Person('logo1.jpg','Jan','Lampa','failed bachelor student','Bad company','+420 777 777 777','lamj00@vse.cz','www.lampicka.cz',false,'Kostelecká',20,100,'Praha','02-10-1995'),
    new Person('logo2.jpg','An','Ampa',' bachelor student','Company','+420 555 555 555','ampa02@vse.cz','www.ampicka.cz',true,'Kostelecká',20,100,'Praha','02-10-1990'),
    new Person('logo3.jpg','Lan','Jampa','succesful bachelor student','Good company','+420 666 666 666','jaml01@vse.cz','www.jampicka.cz',true,'Kostelecká',20,100,'Praha','02-10-1993'),
];
?>
<?php include './includes/header.php'; ?>
    <h1 class="text-center">Business Cards</h1>
    <ul>
        <?php foreach($people as $person): ?>
            <main class="container">
                <div class="business-card bc-front row">
                    <div class="col-sm-4"> 
                        <div class="logo" style="background-image: url(./img/<?php echo $person->avatar; ?>)"></div>
                        <div class="bc-lastname"><?php echo $person->getFullName(); ?></div>
                    </div>
                    <div class="col-sm-8">
                        <div class="bc-title"><?php echo $person->title; ?></div>
                        <div class="bc-company"><?php echo $person->company; ?></div>
                    </div>
                </div>
                <div class="business-card bc-back row">
                    <div class="col-sm-6">
                        <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                        <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                        <div class="bc-title"><?php echo $person->title ?></div>
                    </div>
                    <div class="col-sm-6 contacts">
                        <div class="bc-address"> <?php echo $person->getAdress(); ?></div>
                        <div class="bc-age"> Old <?php echo $person->getAge(); ?> years</div>
                        <div class="bc-phone"> <?php echo $person->phone; ?></div>
                        <div class="bc-email"><?php echo $person->email; ?></div>
                        <div class="bc-website"> <?php echo $person->website; ?></div>
                        <div class="bc-available"><?php echo $person->available ? 'Not available for contracts' : 'Now available for contracts'; ?></div>
                    </div>
                </div>
            </main>
        <?php endforeach; ?>
    </ul>
<?php include './includes/footer.php'; ?>