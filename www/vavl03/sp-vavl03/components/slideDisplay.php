<?php

class Slide {
    public  $img;
    public  $name;
    public function __construct(string $img, string $name)
    {
        $this->img = $img;
        $this->name = $name;
    }
}

$slide1 = new Slide('./img/rtx2080.jpg','RTX_2080');
$slide2 = new Slide('./img/rtx.jpg','GTX_1080');
$slide3 = new Slide('./img/aorus.jpg','AORUS');
$slides = array($slide1,$slide2,$slide3);
