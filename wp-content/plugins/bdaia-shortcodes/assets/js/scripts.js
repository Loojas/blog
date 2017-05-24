/**
 * document ready
 * ========================================================= */

;(function ($) { 'use strict';

    $(document).ready(function($)
    {
        jQuery( 'div.bdaia-flip-container').hover( function (e) {
            jQuery(this).toggleClass('hover', e.type === 'mouseenter');
        });


        jQuery.fn.slideFadeToggle = function(speed, easing, callback) {
            return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
        };

        jQuery("h4.toggle-head-open").click(function () {
            jQuery(this).parent().find("div.toggle-content").stop().slideToggle(400, 'swing', function() {});
            jQuery(this).hide();
            jQuery(this).parent().find("h4.toggle-head-close").show();
            return false;
        });
        jQuery("h4.toggle-head-close").click(function () {
            jQuery(this).parent().find("div.toggle-content").stop().slideToggle(400, 'swing', function() {});
            jQuery(this).hide();
            jQuery(this).parent().find("h4.toggle-head-open").show();
            return false;
        });

        jQuery('.tooltip-nw').tipsy({fade: true, gravity: 'nw'});
        jQuery('.tooltip-ne').tipsy({fade: true, gravity: 'ne'});
        jQuery('.tooltip-w' ).tipsy({fade: true, gravity: 'w' });
        jQuery('.tooltip-e' ).tipsy({fade: true, gravity: 'e' });
        jQuery('.tooltip-sw').tipsy({fade: true, gravity: 'w' });
        jQuery('.tooltip-se').tipsy({fade: true, gravity: 'e' });
        jQuery('.ttip, .tooltip-n'	  ).tipsy({fade: true, gravity: 's'});
        jQuery('.tooldown, .tooltip-s').tipsy({fade: true, gravity: 'n'});
    });

    $(window).resize(function() {
        bdaia_shorty_set_height();
    });

    $(window).load(function () {
        bdaia_shorty_set_height();
    });

})(jQuery);;


/**
 * Set min height
 * ========================================================= */
;function bdaia_shorty_set_height()
{
    var windowHeight = jQuery("div.bdaia-flip-container .bdaia-back").innerHeight();
    jQuery("div.bdaia-flip-container .bdaia-flipper, div.bdaia-flip-container .bdaia-back").css('min-height', windowHeight);
};;