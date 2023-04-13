window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    // window.$ = $.extend(require('jquery-ui'));

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

require('overlayscrollbars');
require('../../vendor/almasaeed2010/adminlte/dist/js/adminlte');

$(document).ready(function () {
    // myaccount
    $('.lgsg_ac.myact > a').click(function () {
        $('.prf_stng').toggle();
        $(".notification_body").hide();
    });
    $(document).ready(function () {
        $(".mse_pd").click(function () {
            $('html, body').animate({
                scrollTop: $(".rcdt_wrp").offset().top - 150
            }, 500);
        });
    });

    // Accordion tab
    $(document).ready(function () {
        $(".set > a").on("click", function () {
            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $(this)
                    .siblings(".content")
                    .slideUp(200);
                $(".set > a i")
                    .removeClass("fa-angle-down")
                    .addClass("fa-angle-right");
            } else {
                $(".set > a i")
                    .removeClass("fa-angle-down")
                    .addClass("fa-angle-right");
                $(this)
                    .find("i")
                    .removeClass("fa-angle-right")
                    .addClass("fa-angle-down");
                $(".set > a").removeClass("active");
                $(this).addClass("active");
                $(".content").slideUp(200);
                $(this)
                    .siblings(".content")
                    .slideDown(200);
            }
        });
    });

    //Slider
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 20000,
        values: [ 100, 10000 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range" ).slider( "values", 1 ) );
});
