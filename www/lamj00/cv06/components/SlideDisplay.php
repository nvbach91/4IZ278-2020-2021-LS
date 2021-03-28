
<?php
$DIR = substr_replace(__DIR__,"",-11);

require "$DIR/db_logic/slidesDB.php";

$slidesDB = new SlidesDB();
$slides = $slidesDB->fetchAll();
/*
INSERT INTO `slides`( `img`, `title`) VALUES ("https://lh5.googleusercontent.com/nnxuiYQwD7VjnNXWyMm2At_eP6vhSd86k5QKlH8ZRpWzo7j2VQ3ANBKhZnwulA2SjtVuDW0v40Ds4KdqynKxrPttLNuEEokNQmjA1Lel2f6fPMr4TE9iBkOBVwczk3HTiq7Akbpi","First slide");
INSERT INTO `slides`( `img`, `title`) VALUES ("https://tparslow.weebly.com/uploads/1/0/9/4/109495987/resident-evil-8-fanart-cover-by-utopya6-dcn3e5w_orig.jpg","Second slide");
INSERT INTO `slides`( `img`, `title`) VALUES ("https://i.pinimg.com/originals/54/ac/cd/54accd0278869e3e520167acac6e747d.jpg","Third slide");
*/
/*
$slides = [
    ['img' => 'https://lh5.googleusercontent.com/nnxuiYQwD7VjnNXWyMm2At_eP6vhSd86k5QKlH8ZRpWzo7j2VQ3ANBKhZnwulA2SjtVuDW0v40Ds4KdqynKxrPttLNuEEokNQmjA1Lel2f6fPMr4TE9iBkOBVwczk3HTiq7Akbpi', 'alt' => 'First slide'],
    ['img' => 'https://tparslow.weebly.com/uploads/1/0/9/4/109495987/resident-evil-8-fanart-cover-by-utopya6-dcn3e5w_orig.jpg', 'alt' => 'Second slide'],
    ['img' => 'https://i.pinimg.com/originals/54/ac/cd/54accd0278869e3e520167acac6e747d.jpg', 'alt' => 'Third slide']
];
*/
?>

<div id="slider" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php foreach($slides as $index=>$slide): ?>
            <li data-target="#slider" data-slide-to="<?php echo $index; ?>" class="<?php echo $index == 0 ? 'active' : ''; ?>"></li>
        <?php endforeach; ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php foreach($slides as $index=>$slide): ?>
            <div class="carousel-item slide <?php echo $index == 0 ? 'active' : ''; ?>">
                <img class="d-block img-fluid slide-image" src="<?php echo $slide['img']; ?>"  alt="<?php echo $slide['title']; ?>">
            </div>
        <?php endforeach; ?>
    </div>
    <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>