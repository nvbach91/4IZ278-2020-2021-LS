<?php
  require './Person.php';

  $personDenis = new Person(
    'Software Developer',
    'logo.svg',
    'Denis',
    'Akopyan',
    'CADTeam s.r.o.',
    '+420 777 666 555',
    'myepicmail@gmail.com',
    'https://github.com/hailstorm75',
    false,
    'Address');

  $personOther = new Person(
    'Lead Designer',
    'logo.svg',
    'Sined',
    'Naypoka',
    'CADTeam s.r.o.',
    '+420 744 655 566',
    'myemail@gmail.com',
    'https://github.com/bob',
    true,
    'Address');

  $people = [$personDenis, $personOther];

?>

<h1>Business card</h1>
<?php foreach ($people as $person): ?>
  <div class="row">
    <div class="business-card-front bc-front col mr-2">
      <div class="col-sm">
        <div class="logo" style="background-image: url(./img/<?php echo $person->getLogo(); ?>)"></div>
      </div>
      <div class="col-sm-7 align-self-sm-center">
        <div class="bc-title"><?php echo $person->getTitle(); ?></div>
        <span class="bc-firstname"><?php echo $person->getFirstname(); ?></span>
        <span class="bc-lastname"><?php echo $person->getLastname(); ?></span>
        <div class="bc-company"><?php echo $person->getCompany(); ?></div>
      </div>
      <div class="col-0-5 align-self-sm-end designer-line"></div>
    </div>

    <div class="business-card-back bc-back col ml-2">
      <div class="col-sm-6">
        <div class="bc-title"><?php echo $person->getTitle() ?></div>
        <span class="bc-firstname"><?php echo $person->getFirstname(); ?></span>
        <span class="bc-lastname"><?php echo $person->getLastname(); ?></span>
      </div>
      <div class="col-sm-6 contacts">
        <div><i class="fas fa-map-marker"></i>&nbsp;<?php echo $person->getAddress(); ?></div>
        <div><i class="fas fa-phone"></i>&nbsp;<?php echo $person->getPhone(); ?></div>
        <div><i class="fas fa-envelope"></i>&nbsp;<?php echo $person->getEmail(); ?></div>
        <div><i class="fab fa-github"></i>&nbsp;<?php echo $person->getWebsite(); ?></div>
        <div><?php echo $person->getWebsite() ? 'Available for contracts' : 'Unavailable for contracts'; ?></div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
