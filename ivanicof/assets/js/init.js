/**
 * File init.js.
 *
 * javascript code for elements
 * 
 */
jQuery(document).ready(function($) {

    var $body = $('body'),
        $menu = $('#site-navigation'),
        $header = $('.site-header'),
        $button = $('#menu_button'),
        $adminbar = $('#wpadminbar'),
        $buttonDown = $('#button-down'),
        $buttonClose = $('#close-button'),
        $buttonUp = $('#button-up');


    jQuery(window).on('scroll', function() { displaybuttonUp() });


    $buttonDown.on('click', function() { $('html,body').animate({ scrollTop: $("#site-navigation").offset().top - 20 }, 1000); });

    $buttonUp.on('click', function() { $('html,body').animate({ scrollTop: 0 }, 1000); });

    if ($adminbar) {
        $margin_height = $adminbar.outerHeight(true) + 10;
        $button.css({ 'top': $margin_height + 'px' })
    }

    $button.on('click', function() { $menu.addClass('toggled'); });
    $buttonClose.on('click', function() { $menu.removeClass('toggled'); });
    $button.on('focus', function() { $menu.toggleClass('toggled'); });

    function displaybuttonUp() {
        var $top = jQuery(this).scrollTop();

        if ($top >= $header.outerHeight(true)) {
            $buttonUp.css({ 'bottom': '2rem' });

            $menu.addClass('fixed');
            if ($adminbar && $body.width() >= 600) {
                $('.main-navigation.fixed').css({ 'top': $adminbar.outerHeight(true) + 'px' })
            }
        } else {
            $buttonUp.css({ 'bottom': '-5rem' });
            $menu.removeClass('fixed');
            $('.main-navigation').css({ 'top': '0' })
        }

    }

    displaybuttonUp();

    $('.flexslider').flexslider({
        animation: "slide",
        selector: ".slides > li",
        animationLoop: true,
        prevText: "",
        nextText: "",
        controlNav: false,
        itemWidth: 300,
        itemMargin: 5
    });

    $('#site-navigation a').focus(toggleFocus).blur(toggleFocus);

    function toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while (-1 === self.className.indexOf('main-navigation')) {

            // On li elements toggle the class .focus.
            if ('li' === self.tagName.toLowerCase()) {
                if (-1 !== self.className.indexOf('focus')) {
                    self.className = self.className.replace(' focus', '');
                } else {
                    self.className += ' focus';
                }
            }

            self = self.parentElement;
        }
    }


});