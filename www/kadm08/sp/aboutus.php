<?php
session_start();
?>

<?php include __DIR__ . '/includes/header.php'; ?>
<div class="bg-light">
    <div class="container py-5">
        <div class="row h-100 align-items-center py-5">
                <h3 class="display-5">About us</h3>
                <p class="lead text-muted mb-0">Coworking Smetana is a coworking space in Český Těšín that was designed from 
                day one for solo-workers: freelancers, writers, digital nomads, solopreneurs, and other remote workers and 
                location-independent professionals who would prefer to work alongside other people than alone.
               </p>
        </div>
    </div>
</div>

<div class="bg-white py-5">
  <div class="container py-5">
    <div class="row align-items-center mb-5">
      <div class="col-lg-6 order-2 order-lg-1"><i class="fa fa-bar-chart fa-2x mb-3 text-primary"></i>
        <h3 class="font-weight-light">Flexibility is the key to success</h3>
        <p class="font-italic text-muted mb-4">You can book your worpklace for as long as you need. 
        There are no fixed terms contracts or complicated membership plans. If you have any question do not hesitate to drop us a message.</p><a href="contact.php" class="btn btn-light px-5  shadow-sm">Contact us</a>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-lg-5 px-5 mx-auto"></div>
      <div class="col-lg-6">
        <h3 class="font-weight-light">We take pride in our community</h3>
        <p class="font-italic text-muted mb-4"> We make it easy to get to know other members by offering a host of informal events that all members are welcome to join, 
                from weekly lunches and coffee breaks, to monthly pub nights and game nights, to productivity-enhancing group work sessions, 
                to workshops and talks promoting professional development. Just sign up and start exploring.</p><a href="register.php" class="btn btn-light px-5  shadow-sm">Sign up</a>
      </div>
    </div>
  </div>
</div>


<?php include __DIR__ . '/includes/footer.php'; ?>