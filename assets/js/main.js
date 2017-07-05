/**
 * Created by roman on 03.07.2017.
 */
$(document).ready(function(){

    var popup     = $('.feedback'),
        openPopup = $('.popup-open'),
        formBtn   = $('#send-form'),
        formName  = $(formBtn).find('#name'),
        formEmail = $(formBtn).find('#email');

    $('.owl-carousel').owlCarousel({
        items:1,
        margin:0,
        loop:true,
        autoplay:true,
        autoplayTimeout:7000,
        smartSpeed:1000
    });


    $('.nav-list_item_link').click(function(event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;

        $('html,body').animate({scrollTop: top}, 400);
    });

    $(openPopup).click(function() {
        popup.fadeIn(200);
    });

    $('.footer-wrap').find('.logo').click(function () {
        scroll(0);
    });

    $(popup).find('.close, .blackout').click(function() {
        $(popup).fadeOut(200);
    });

    function scroll(a) {
        $('html, body').animate({scrollTop:a}, 400);
    }
});