window.addEventListener( "load", function () {
    r1_preloader();
    r1_menu_equal_width();
    r1_button_up();
});

jQuery(window).resize( function () {

});

jQuery(window).on( 'orientationchange', function () {

});

/**
 * Hide preloader after small delay for smooth page loading.
 *
 * @since    1.0.0
 */
function r1_preloader() {
    setTimeout(function(){
        jQuery('.r1-preloader').addClass('hidden');
    }, 400);
}

/**
 * Centering menu in flexible container.
 *
 * @since    1.0.0
 */
function r1_menu_equal_width() {
    let minWidht = 0;

    jQuery('.r1-header__container > *:not(.r1-header__nav)').each(function(i, el) {
        minWidht = jQuery(el).width() > minWidht ? jQuery(el).width() : minWidht;
    });

    jQuery('.r1-header__container > *:not(.r1-header__nav)').css('min-width', minWidht + 'px');
}

/**
 * Scripts for scroll to top button. 
 *
 * @since    1.0.0
 */
function r1_button_to_top() {
    jQuery(window).on('scroll', function() {
        if( jQuery(this).scrollTop() > 400 ){
            jQuery('.r1-button-up').addClass('active');
        } else {
            jQuery('.r1-button-up').removeClass('active');
        }
    });

    jQuery('.r1-button-up').on('click', function() {
        jQuery('body,html').animate({'scrollTop':0}, 1200);

        jQuery('.r1-site-nav a').addClass('disabled');
        jQuery('.r1-header.sticky').addClass('disabled');

        setTimeout(function(){
            jQuery('.r1-header.sticky').removeClass('disabled');
            jQuery('.r1-site-nav a').removeClass('disabled');
        }, 1200);
    });
}