<?php include './includes/header.php'; ?>

<?php
require './Person.php';
$fremen = [
    new Person('Paul', "Muad'Dib", 'Arrakis', 'img/paul.jpg', 'http://corndog.io/', 'paul@dune.com', '+420 666 666 666', 'Available'),
    new Person('Chani', "Kynes", 'Arrakis', 'img/chani.jpg', 'http://corndog.io/', 'chani@dune.com', '+420 555 555 555', 'Not Available'),
]
?>

<?php foreach ($fremen as $f) : ?>
    <div class="card front">
        <img src="<?php echo $f->photo ?>" alt="photo">
        <div class="info">
            <ul class="fa-ul">
                <li>
                    <span class="fa-li"><i class="fas fa-location-arrow"></i></span>
                    <?php echo $f->planet ?>
                </li>
                <li>
                    <span class="fa-li"><i class="far fa-user"></i></span>
                    <?php echo $f->getFullName() ?>
                </li>
                <li>
                    <span class="fa-li"><i class="fas fa-phone-alt"></i></span>
                    <?php echo $f->phone ?>
                </li>
                <li>
                    <span class="fa-li"><i class="fas fa-envelope-square"></i></span>
                    <?php echo $f->email ?>
                </li>
                <li>
                    <span class="fa-li"><i class="fas fa-globe"></i></span>
                    <?php echo $f->web ?>
                </li>
                <li>
                    <span class="fa-li"><i class="fas fa-bell"></i></span>
                    <?php echo $f->status ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="card back"></div>
<?php endforeach; ?>

<?php include './includes/footer.php'; ?>
