animContainer = document.getElementById('logo_animation');

var params = {
    container: animContainer,
    renderer: 'svg',
    loop: false,
    autoplay:false,
    autoloadSegments: false,
    path: 'assets/src/json/logo.json'
};

var anim;
    anim = bodymovin.loadAnimation(params);
    animContainer.addEventListener("mouseenter", myScript1);
    animContainer.addEventListener("mouseleave", myScript2);

function myScript1(){
    bodymovin.setDirection(1);
    anim.play();
}

function myScript2(){
    bodymovin.setDirection(-1);
    anim.play();
};