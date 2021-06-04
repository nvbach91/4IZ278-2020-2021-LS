$(document).ready(() => {
    const dummyFooter = document.getElementById("dummyFooter");
    const footer = document.getElementById("footer");
    const mainHome = document.getElementById("mainHome");
    const mainLections = document.getElementById("mainLections");
    const mainMyLessons = document.getElementById("mainMyLessons");
    const mainCoaches = document.getElementById("mainCoaches");
    const mainGyms = document.getElementById("mainGyms");
    const mainLogin = document.getElementById("mainLogin");
    const mainRegister = document.getElementById("mainRegister");

    const nav = document.getElementById("nav");
    const body = document.body, html = document.documentElement;

    const height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );

    const getActiveMain = () =>{
        if(mainLections){
            return mainLections.offsetHeight - 62.5;
        } else if(mainMyLessons){
            return mainMyLessons.offsetHeight - 14
        } else if(mainHome){
            return mainHome.offsetHeight
        } else if(mainCoaches){
            return mainCoaches.offsetHeight - 63
        } else if(mainGyms){
            return mainGyms.offsetHeight
        } else if(mainLogin){
            return mainLogin.offsetHeight
        } else if(mainRegister){
            return mainRegister.offsetHeight
        }
        else {
            return 0
        }
    }
    dummyFooter.style.height = height - nav.offsetHeight - getActiveMain() - footer.offsetHeight - 80 + "px";
})

//disable dvojkliku *při registraci
function clickAndDisable(link) {
    // disable subsequent clicks
    link.onclick = function(event) {
        event.preventDefault();
    }
}
