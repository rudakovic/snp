let i = 25;
let headerHeight = document.getElementsByTagName("header")[0].offsetHeight;
let beforePosition = 0;
const eventDate = dateOfEvent.split(',');

window.onload = function() {
    navStyle();
    getTime();
    setInterval(getTime, 1000);


    $("video").delay(1000).fadeIn(1000);
    $(".button-container").delay(5000).fadeIn(1000);
    document.getElementsByTagName('video')[0].play();

    const no_date_switch = document.getElementById('bez_prebacivanja_dana').value;
    let agendas = document.getElementsByClassName('agenda-point-container');
    let buttons = document.querySelectorAll(".buttons-container button");

    if(no_date_switch === '0') {
        for(let i = 0; i < agendas.length; i++) {
            (agendas[(agendas.length-1)].id !== agendas[i].id) ? (agendas[i].classList.add("d-none"), buttons[i].classList.remove("selected")) : (agendas[i].classList.remove("d-none"), buttons[i].classList.add("selected"))
        }
    }




};
let getTime = () => {

    const oneDay = 24 * 60 * 60 * 1000;
    const currentDate = new Date();

    const finalDate = new Date(parseInt(eventDate[0]), parseInt(eventDate[1])-1, parseInt(eventDate[2]), parseInt(eventDate[3]), parseInt(eventDate[4]), parseInt(eventDate[5]));

    const days = (finalDate - currentDate) / oneDay;
    const hours = (days - Math.floor(days)) * 24;
    const minutes = (hours - Math.floor(hours)) * 60;
    const seconds = (minutes - Math.floor(minutes)) * 60;
    let daysT = "dana";
    let hoursT = "h";
    let minutesT = "min";
    let secondsT = "sec";

    (Math.floor((days/10 - Math.floor(days/10))*10) === 1) && (daysT = "dan");


    if(!isNaN(days)) {
        document.getElementById("days").innerHTML = Math.floor(days);
        document.getElementById("daysT").innerHTML = daysT;
        document.getElementById("hours").innerHTML = Math.floor(hours);
        document.getElementById("hoursT").innerHTML = hoursT;
        document.getElementById("minutes").innerHTML = Math.floor(minutes);
        document.getElementById("minutesT").innerHTML = minutesT;
        document.getElementById("seconds").innerHTML = Math.floor(seconds);
        document.getElementById("secondsT").innerHTML = secondsT;
    }


};
getTime();



let showDate = (el) => {
    let agendas = document.getElementsByClassName('agenda-point-container');
    let buttons = document.querySelectorAll(".buttons-container button");
    for(let i = 0; i < agendas.length; i++) {
        (el.id !== agendas[i].id) ? (agendas[i].classList.add("d-none"), buttons[i].classList.remove("selected")) : (agendas[i].classList.remove("d-none"), buttons[i].classList.add("selected"))
    }
};

let menuEffect = (el) => {
    el.classList.toggle("pomeriAfter");
    el.getElementsByClassName("bar")[2].classList.toggle("bar3");
    el.getElementsByClassName("bar")[0].classList.toggle("bar1");
    document.getElementsByClassName("linkovi")[0].classList.toggle("move");
    document.getElementsByClassName("mobile-menu-hamburger")[0].classList.toggle("border");
    document.getElementsByClassName("nav-bar")[0].classList.toggle("opacity");
};



let $root = $('html, body');

$('a[href^="#"]').click(function (el) {
    $root.animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top - (0.15 * window.innerHeight)
    }, 500);
    (screen.width < 960) && (menuEffect(document.getElementsByClassName("pomeriAfter")[0]));
    return false;
});

let navStyle = () => {
    let linkovi = document.getElementsByClassName("linkovi")[0].getElementsByTagName("a");
    let links = [];
    for(let i = 0; i < linkovi.length; i++) {
        links[i] = linkovi[i].getAttribute("href").substr(1);
    }
    window.onscroll = () => {
        let logoDiv = document.getElementsByClassName("logo-container")[0];
        (screen.width < screen.height) && (i = 30);
        let movement = 2*i*window.scrollY/headerHeight;
        if(headerHeight >= window.scrollY) {
            movement = i - movement;
            if (movement >= 0 && movement <= i) {
                logoDiv.style.top = movement + "%";
                beforePosition = window.scrollY;
            }
        }

        let navBar = document.getElementsByClassName("nav-bar")[0];
        ((window.scrollY + screen.height/2) > (screen.height + navBar.offsetTop)) && (document.getElementsByClassName("nav-bar")[0].classList.add("fixed"));
        ((window.scrollY + screen.height/2) < (screen.height + navBar.offsetTop)) && (document.getElementsByClassName("nav-bar")[0].classList.remove("fixed"))
        for(let i = 0; i < links.length; i++) {
            let firstEl = document.getElementById(links[i]);
            let secondEl = document.getElementById(links[i+1]);
            if (window.scrollY + document.getElementById(links[links.length-1]).offsetHeight < document.getElementById(links[1]).offsetTop) {
                linkovi[0].classList.add("fullDot");
            } else if((firstEl.offsetTop + (0.7 * window.innerHeight)) < window.scrollY && (secondEl.offsetTop + (0.9 * window.innerHeight)) > window.scrollY) {
                linkovi[i].classList.add("fullDot");
                (linkovi[i+1].classList.contains("fullDot")) && (linkovi[i+1].classList.remove("fullDot"));
                ((i-1) >= 0) && (linkovi[i-1].classList.contains("fullDot")) && (linkovi[i-1].classList.remove("fullDot"));
            } else if (window.scrollY + 0.5 * document.getElementById(links[links.length-1]).offsetHeight > document.getElementById(links[links.length-1]).offsetTop || window.scrollY  + window.innerHeight === document.body.offsetHeight) {
                linkovi[links.length-1].classList.add("fullDot");
                linkovi[links.length-2].classList.remove("fullDot");

            }

        }
    };

};

$('.center').slick({
    centerMode: true,
    centerPadding: '60px',
    arrows: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow: '<button type="button" class="slick-prev"><span class="dashicons dashicons-arrow-left-alt2"></span></button>',
    nextArrow: '<button type="button" class="slick-next"><span class="dashicons dashicons-arrow-right-alt2"></span></button>',
    responsive: [
        {
            breakpoint: 768,
            settings: {
                arrows: true,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: true,
                centerMode: true,
                centerPadding: '20px',
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
            }
        }
    ]
});


$('#sendThisMail').on('submit', function(e){

    event.preventDefault();
/*
    $('.has-error').removeClass('has-error');
    $('.js-show-feedback').removeClass('js-show-feedback');
*/

    var form = $(this),
        name = form.find('#nameM').val(),
        email = form.find('#emailM').val(),
        number = form.find('#numberM').val(),
        message = form.find('#messageM').val(),
        ajaxurl = form.data('url');

    form.find('input, button, textarea').attr('disabled','disabled');
    document.getElementsByClassName("ajax-msgM")[0].innerHTML = "Poruka se šalje.";

        $.ajax({
        url: ajaxurl,
        type : 'post',
        data : {

            name : name,
            email : email,
            number : number,
            message : message,
            action: 'nocni_send_email_back'

        },
        error : function( response ){
            /*console.log('err');*/
            document.getElementsByClassName("ajax-msgM")[0].innerHTML = "Poruka nije poslata!";
            form.find('input, button, textarea').removeAttr('disabled');

        },
        success : function( response ){
            /*console.log('succ');*/
            setTimeout(function(){
                form.find('input, button, textarea').removeAttr('disabled');
                form.find('input, button, textarea').innerHTML = "";
                document.getElementsByClassName("ajax-msgM")[0].innerHTML = "Poruka uspešno poslata!";

            },1500);
        }

    });

});

$('#sendThisEntry').on('submit', function(e){

    event.preventDefault();

    var form = $(this),
        name = form.find('#name').val(),
        lastname = form.find('#lastname').val(),
        email = form.find('#email').val(),
        number = form.find('#number').val(),
        ajaxurl = form.data('url');

    form.find('input, button, textarea').attr('disabled','disabled');
    document.getElementsByClassName("ajax-msg")[0].innerHTML = "Prijava se šalje.";

    $.ajax({
        url: ajaxurl,
        type : 'post',
        data : {

            name : name,
            lastname : lastname,
            email : email,
            number : number,
            action: 'nocni_send_entry_back'

        },
        error : function( response ){
            /*console.log('err')*/
            document.getElementsByClassName("ajax-msg")[0].innerHTML = "Prijava nije poslata!";
            form.find('input, button, textarea').removeAttr('disabled');

        },
        success : function( response ){
            /*console.log('succ')*/
            setTimeout(function(){
                form.find('input, button, textarea').removeAttr('disabled');
                form.find('input, button, textarea').innerHTML = "";
                document.getElementsByClassName("ajax-msg")[0].innerHTML = "Prijava uspešno poslata!";

            },1500);
        }

    });

});



$('input').on('focusin', function() {
    $(this).parent().find('label').addClass('active');
});

$('input').on('focusout', function() {
    if (!this.value) {
        $(this).parent().find('label').removeClass('active');
    }
});

$('textarea').on('focusin', function() {
    $(this).parent().find('label').addClass('active');
});

$('textarea').on('focusout', function() {
    if (!this.value) {
        $(this).parent().find('label').removeClass('active');
    }
});

let showVolontiranje = () => {
    document.getElementsByClassName('prijava-volontiranje')[0].classList.toggle("show-volontiranje");

};

let writeUs = () => {
    document.getElementById("nameM").focus();
    document.getElementsByClassName('sendMail')[0].getElementsByTagName('h4')[0].classList.add('blink');
    setTimeout(function(){
        document.getElementsByClassName('sendMail')[0].getElementsByTagName('h4')[0].classList.remove('blink');

    },2000);

};