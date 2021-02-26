<?php require './classes/Person.php'; ?>

<?php
  $people = [
    new Person(
        'facebook-logo.png',
         'Denny',
         'Nguyen',
         'CTO',
         'Facebook',
         '+420 690 069 609',
         'denny.nguyen@facebook.com',
         'www.facebook.com',
         'Ulická',
         '420',
         '69',
         'Ostravo',
         '420 00',
        ),
    new Person(
        'facebook-logo.png',
         'John',
         'Doe',
         'CEO',
         'Facebook',
         '+420 690 069 609',
         'john.doe@facebook.com',
         'www.facebook.com',
         'Street Ave',
         '690',
         '42',
         'Murica',
         '139 00',
        ),
  ]
?>

<ul class="business-cards">
  <?php foreach($people as $person): ?>
  <li>
    <div class="business-card">
      <div class="info">
        <div class="firstname"><?php echo $person->firstName; ?></div>
        <div class="lastname"><?php echo $person->lastName; ?></div>
        <div class="title"><?php echo $person->role; ?></div>
        <div class="company"><?php echo $person->company; ?></div>
      </div>
      <div>
        <img class="logo" src="./assets/img/<?php echo $person->logo; ?>"></img>
      </div>
    </div>
    <div class="business-card">
      <div class="contacts">
        <div class="address"><?php echo $person->getFullAddress(); ?></div>
        <div class="phone"><?php echo $person->phone; ?></div>
        <div class="email"><?php echo $person->email; ?></div>
        <div class="website"><?php echo $person->website; ?></div>
      </div>
      <div>
        <div class="firstname"><?php echo $person->firstName; ?></div>
        <div class="lastname"><?php echo $person->lastName; ?></div>
        <div class="title"><?php echo $person->role ?></div>
      </div>
    </div>
  </li>
  <?php endforeach; ?>
</ul>