<?php
require "incl/header.php";
require "incl/navbar.php";
?>

<header class="page-header ">
    <div class="container pt-3">
        <div class="align-items-center row justify-content-center ">
            <div class="col-md-6">
                <h1>Get all newest hardware for your computer</h1>

            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fdbb2d" fill-opacity="1" d="M0,192L48,181.3C96,171,192,149,288,160C384,171,480,213,576,234.7C672,256,768,256,864,250.7C960,245,1056,235,1152,224C1248,213,1344,203,1392,197.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
</header>
<div class="container ">
    <div class="col-md-6 ">
        <h2>We have components from your favorite company</h2>
    </div>
    <div class="scrolling-wrapper-flexbox">
        <img class="icon shad" src="img/intel_icon.png">
        <img class="icon shad" src="img/amd_icon.png">
        <img class="icon shad" src="img/nvidia_icon.png">
        <img class="icon shad" src="img/kingston-icon.png">
        <img class="icon shad" src="img/intel_icon.png">
        <img class="icon shad" src="img/amd_icon.png">
        <img class="icon shad" src="img/nvidia_icon.png">
        <img class="icon shad" src="img/kingston-icon.png">
    </div>
</div>
<div class="container " >
    <div class="col-md-6 ">
        <h2>Browse by component type</h2>
    </div>
    <div class="scrolling-wrapper-flexbox">
        <a href="eshop.php?category=Processors"> <img class="icon" src="img/cpu_icon.png"> </a>
        <a href="eshop.php?category=RAM"><img class="icon" src="img/RAM_icon.png"> </a>
        <a href="eshop.php?category=Motherboards"><img class="icon" src="img/MB_icon.png"> </a>
        <a href="eshop.php?category=HDD"><img class="icon" src="img/HDD_icon.png"> </a>
        <a href="eshop.php?category=Graphics cards"><img class="icon" src="img/graphic_card_icon_2.png"> </a>
        <a href="eshop.php?category=SSD"><img class="icon" src="img/SSD_icon.png"> </a>
        <a href="eshop.php?category=Coolers"><img class="icon" src="img/cooler_icon.png"> </a>
    </div>
</div>

<?php
require  "incl/footer.php";
?>


