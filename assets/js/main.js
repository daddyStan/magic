/**
 * Created by roman on 03.07.2017.
 */
$(document).ready(function(){

    var popup     = $('.feedback'),
        openPopup = $('.popup-open'),
        priceItem  = $('.price-item'),
        priceHover = $('.price-hover');

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
    $(priceItem).hover(function() {
        $(this).find(priceHover).toggleClass('active');
    });
    function scroll(a) {
        $('html, body').animate({scrollTop:a}, 400);
    }
});

function mail() {
    var pop = $("#feedback-popup").find("input");
    var name = $("#name").val();
    var email= $("#email").val();
    var feedback= $("#feedback").val();
    if(name ==="" || email === "" || feedback === "") {
        pop.addClass("err");
    } else {
        pop.removeClass("err");
        $.ajax({
            type: "POST",
            url: '/sendmail',
            data: {name:name,email:email,feedback:feedback},
            success: function(data){
                console.log(data);
                if(data === 'good') {
                    $('.feedback').toggle();
                    $("#name").val("")
                    $("#email").val("")
                    $("#feedback").val("")
                }
            }
        });
    }

}