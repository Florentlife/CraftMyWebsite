// WOW.JS INIT

new WOW().init();


// TOOLTIPS

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

//<![CDATA[
$(window).on('load', function () { // makes sure the whole site is loaded 
    $('#status').fadeOut(); // will first fade out the loading animation 
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
    $('body').delay(350).css({
        'overflow': 'visible'
    });
})
//]]>
