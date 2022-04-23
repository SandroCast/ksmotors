window.addEventListener('scroll', function(){

    var windowTop = window.pageYOffset;
    if(windowTop > 300) {
        var navtop = window.document.getElementById('navbartop');
        navtop.style.marginTop = '-35px'
        navtop.style.backgroundColor = 'black'
        navtop.style.transition = '500ms'
    }else{
            var navtop = window.document.getElementById('navbartop');
            navtop.style.marginTop = '0px'
            navtop.style.backgroundColor = '#00000000'
            navtop.style.transition = '500ms'

    }


})

function srl(click){
    document.getElementById(click).scrollIntoView(true);
}

window.addEventListener('click', function(){

    var conf = window.document.getElementById('config');

    if(conf.style.display == 'flex') {
        conf.style.display = 'block'
    }else {
        conf.style.display = 'none'
    }
})

function conf_mini(){

    var conf = window.document.getElementById('config');
    if(conf.style.display == 'block') {
    }else {
        conf.style.display = 'flex'
    }
}