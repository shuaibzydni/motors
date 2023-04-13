$(document).ready(function () {
    $("#testimonial-slider").owlCarousel({
        items: 1,
        itemsDesktop: [1000, 1],
        itemsDesktopSmall: [979, 1],
        itemsTablet: [768, 1],
        pagination: false,
        navigation: true,
        navigationText: ["", ""],
        autoPlay: false
    });
    $("#testimonial-slider1").owlCarousel({
        items: 2,
        itemsDesktop: [1000, 2],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 1],
        pagination: false,
        navigation: true,
        navigationText: ["", ""],
        autoPlay: false
    });

    // myaccount
    $('.lgsg_ac.myact > a').click(function () {
        $('.prf_stng').css('display', 'block');
    });
    $('.prf_stng').mouseleave(function () {
        $('.prf_stng').css('display', 'none');
    });

    // password 
    $("#psdwr1").click(function () {

        if ($("#pass1").attr("type") == "password") {
            //Change type attribute
            $(this).addClass('opne');
            $("#pass1").attr("type", "text");
        } else {
            //Change type attribute
            $(this).removeClass('opne');
            $("#pass1").attr("type", "password");
        }
    });
    $("#psdwr2").click(function () {

        if ($("#pass2").attr("type") == "password") {
            //Change type attribute
            $(this).addClass('opne');
            $("#pass2").attr("type", "text");
        } else {
            //Change type attribute
            $(this).removeClass('opne');
            $("#pass2").attr("type", "password");
        }
    });
    $("#psdwr3").click(function () {

        if ($("#pass3").attr("type") == "password") {
            //Change type attribute
            $(this).addClass('opne');
            $("#pass3").attr("type", "text");
        } else {
            //Change type attribute
            $(this).removeClass('opne');
            $("#pass3").attr("type", "password");
        }
    });

});

