var $ = jQuery.noConflict();

window.addEventListener( "load", function () {
    r1_preloader();
    r1_menu_equal_width();
});

$(window).resize( function () {

});

$(window).on( 'orientationchange', function () {

});

/**
 * Hide preloader after small delay for smooth page loading.
 *
 * @since    1.0.0
 */
function r1_preloader() {
    setTimeout(function(){
        $('.r1-preloader').addClass('hidden');
    }, 400);
}

/**
 * Centering menu in flexible container.
 *
 * @since    1.0.0
 */
function r1_menu_equal_width() {
    let minWidht = 0;

    $('.r1-header__container > *:not(.r1-header__nav)').each(function(i, el) {
        minWidht = $(el).width() > minWidht ? $(el).width() : minWidht;
    });

    $('.r1-header__container > *:not(.r1-header__nav)').css('min-width', minWidht + 'px');
}
