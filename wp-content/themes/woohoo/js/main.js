/**
 * global window
 * global document
 * global jQuery
 * global bd
 * global aia
 * @name fn
 * @class
 * @memberOf $
 */

;(function($) { 'use strict';

    var config = $.parseJSON(bd);
    var aia = {
        'config': config
    };
    window.aia = aia;
})(jQuery);;

/**
 * document ready
 * ========================================================= */

var i_refresh = {};
;(function ($) { 'use strict';

    $(document).ready(function($) {
        jQuery('input, textarea').placeholder();
        jQuery("body").fitVids();
        jQuery(".prev, .nxt, .flex-next, .flex-prev, .bdaia-load-comments-btn a").click(function(event){ event.preventDefault(); });
        jQuery(window).on( 'scroll', woohoo_on_scroll );
        woohoo_on_scroll();
        woohoo_retina();
        woohoo_ttip();
        woohoo_sticky_nav();
        woohoo_sticky_sidebar();
        woohoo_youtube_zindex();
        woohoo_Reading_post_bar();
        woohoo_check_also();
        woohoo_mobile_menu();
        woohoo_go_top();
        woohoo_menu_tabs();
        woohoo_menu_15();
        woohoo_menu_search();
        woohoo_post_like();
        woohoo_ilightbox();
        woohoo_post_scroll();
        woohoo_breaking();

        i_refresh = jQuery('a.lightbox-enabled, a[rel="lightbox-enabled, .woohoo-video-ilightbox"]').iLightBox({autostart: false});
        jQuery( 'a.lightbox-enabled, a[rel="lightbox-enabled"], .woohoo-video-ilightbox' ).iLightBox({autostart: false});

        if( aia.config.click_to_comments ){
            woohoo_add_comment();
        }

        jQuery( '.post-style10-cover' ).click(function(event) { event.preventDefault();
            jQuery( '.post-style10-head .bdaia-post-featured-video' ).append( jQuery(".post-style10-head textarea.embed-code").val() ).fitVids();
            jQuery( '.post-style10-head textarea.embed-code, .post-style10-cover' ).remove();

            jQuery( ".post-style10-head .post-style10-cover-bg .post-style10-cover" ).slideDown( 1000, function() {
                jQuery( this ).css( "height", "100%" );
            });
        });

        jQuery('.woohoo-login-join-btn').click(function(){
            jQuery.iLightBox([
                {
                    URL: '#woohoo-login-join',
                    type: 'inline',
                    options: {
                        width: 500,
                        height: 500
                    }
                }
            ],{
                skin: 'metro-black'
            });
            return false;
        });

        jQuery('div.woohoo-login-join-footer-signup span').click(function(){
            jQuery('div#woohoo-login-join .woohoo-login-join-wrapper').removeClass('woohoo-login-join-onlogin');
            jQuery('div#woohoo-login-join .woohoo-login-join-wrapper').addClass('woohoo-login-join-onsignup').fadeIn();
        });

        jQuery('div.woohoo-login-join-footer-login span').click(function(){
            jQuery('div#woohoo-login-join .woohoo-login-join-wrapper').removeClass('woohoo-login-join-onsignup');
            jQuery('div#woohoo-login-join .woohoo-login-join-wrapper').addClass('woohoo-login-join-onlogin').fadeIn();
        });
    });

    $(window).resize(function() {
        woohoo_setHeight();
    });

    $(window).load(function () {
        woohoo_setHeight();
    });

})(jQuery);;

/**
 * Retina
 * ========================================================= */
;
function woohoo_retina()
{
    if ( window.devicePixelRatio > 1 )
    {
        jQuery('.woohoo-retina').each(function()
        {
            var lowres = jQuery(this).attr('src');
            var highres = lowres.replace(".png", "@2x.png");

            highres = highres.replace(".jpg", "@2x.jpg");
            jQuery(this).attr('src', highres);
        });

        jQuery('.woohoo-retina-data').each(function() {
            jQuery(this).attr('src', jQuery(this).data('retina'));
            jQuery(this).addClass('woohoo-retina-src');
        });

    }
};;


/**
 * Breaking
 * ========================================================= */
;function woohoo_breaking()
{
    jQuery( '.breaking-cont ul' ).each(function()
    {
        if ( ! jQuery(this).find( 'li.active' ).length ) {
            jQuery(this).find( 'li:first' ).addClass('active fadeIn');
        }

        var ticker = jQuery( this );
        window.setInterval( function() {

            var active = ticker.find('li.active');
            active.fadeOut(function() {

                var next = active.next();
                if (!next.length) {
                    next = ticker.find('li:first');
                }

                next.addClass('active fadeIn').fadeIn();
                active.removeClass('active fadeIn');
            });

        }, 5000);
    });
};;


/**
 * Scroll post
 * ========================================================= */
;function woohoo_post_scroll()
{
    jQuery(".bdaia-post-read-down a").click(function(event){
        event.preventDefault();

        var bdaiaDHeight = jQuery(window).height() - jQuery( '.bdaia-post-style6-head, .bdaia-post-style7-head' ).height() - jQuery( '#header' ).height() - jQuery( '.bdaia-header-ad-desktop, .bdaia-header-ad-mobile' ).height();

        jQuery('body').stop().animate({
            scrollTop: jQuery(".bdaia-post-template article").offset().top - bdaiaDHeight
        }, 500);

        return false;
    });
};;


/**
 * Ilight box
 * ========================================================= */
;function woohoo_ilightbox()
{
    if( aia.config.all_lightbox )
    {
        var $pos_class = jQuery( 'article.post' );
        $pos_class.find( "div.bdaia-post-content a" ).not( "div.bdaia-post-gallery a" ).each(function(i, el)
        {
            var href_value = el.href;
            if ( /\.(jpg|jpeg|png|gif)$/.test(href_value ) )
            {
                jQuery(this).iLightBox( { path: 'horizontal' } );
            }
        });

        $pos_class.find( '.ilightbox-gallery' ).iLightBox( { path: 'horizontal' } );
    }
};;


/**
 * Add comment
 * ========================================================= */
;function woohoo_add_comment()
{
    jQuery( ".bdaia-load-comments-btn" ).fadeIn('fast');
    jQuery( "#comments.comments-container" ).hide();
    jQuery( "#respond.comment-respond" ).hide();
    jQuery( ".bdaia-load-comments-btn a" ).bind("click",function(){
        jQuery( ".bdaia-load-comments-btn" ).hide();
        jQuery("#comments.comments-container").fadeIn('fast');
        jQuery("#respond.comment-respond").fadeIn('fast');
    });

};;


/**
 * Menu search
 * ========================================================= */
;function woohoo_menu_search()
{
    var $me_sea = jQuery(".bdaia-nav-search");

    jQuery(".bdaia-nav-search .bdaia-ns-btn").bind("click",function(){
        if( jQuery(this).hasClass("bdaia-ns-open") ){
            jQuery(this).removeClass("bdaia-ns-open");
            $me_sea.removeClass("bdaia-ns-open");
            return false
        }
        else {
            jQuery(this).addClass("bdaia-ns-open");
            $me_sea.addClass("bdaia-ns-open");
            return false
        }
    });
};;


/**
 * Menu 15 new articles
 * ========================================================= */
;function woohoo_menu_15()
{
    var $me_n_articles = jQuery(".bdaia-alert-new-posts-content");

    jQuery("#navigation .bdaia-alert-new-posts").bind("click",function(){
        if( $me_n_articles.hasClass("bdaia-alert-new-posts-open") ){
            $me_n_articles.removeClass("bdaia-alert-new-posts-open");
            return false;
        }
        else {
            $me_n_articles.addClass("bdaia-alert-new-posts-open");
            return false;
        }
    });
};;


/**
 * Menu tabs
 * ========================================================= */
;function woohoo_menu_tabs()
{
    jQuery("div.mega-cat-wrapper").each(function()
    {
        jQuery( this ).find("div.mega-cat-content-tab").hide();
        jQuery( this ).find("ul.mega-cat-sub-categories li:first").addClass("cat-active").show();
        jQuery( this ).find("div.mega-cat-content-tab:first").addClass("already-loaded").show();

        jQuery( this ).find("ul.mega-cat-sub-categories li").mouseover(function( event )
        {
            event.preventDefault();
            jQuery( this ).parent().find("li").removeClass("cat-active");
            jQuery( this ).addClass("cat-active");
            jQuery( this ).parent().parent().parent().find("div.mega-cat-content-tab").hide();

            var act_tab = jQuery(this).find("a").attr("id");

            if( jQuery(act_tab).hasClass( "already-loaded" ) ){
                jQuery(act_tab).fadeIn('fast');
            }
            else {
                jQuery(act_tab).addClass("loading-items").fadeIn( 'fast' , function() {
                    jQuery( this ).removeClass("loading-items").addClass("already-loaded");
                });
            }
            return false;
        });
    });
};;


/**
 * Go top
 * ========================================================= */
;function woohoo_go_top()
{
    var bdGoTopOffset      = 220;
    var bdGoTopDuration    = 500;
    var bdGoTopClass       = jQuery('.gotop');

    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > bdGoTopOffset){
            bdGoTopClass.css({ opacity: "1", bottom: "50px" });
        }
        else {
            bdGoTopClass.css({ opacity: "0", bottom: "-100px" });
        }
    });

    bdGoTopClass.click(function(event){
        event.preventDefault();
        jQuery( "html, body" ).animate( {scrollTop: 0}, bdGoTopDuration );
        return false;
    });
};;


/**
 * Mobile Menu
 * ========================================================= */
;function woohoo_mobile_menu()
{
    jQuery(".bd-ClickOpen").click(function()
    {
        var bd_page        = jQuery('#page');
        var bd_body        = jQuery('body');
        var bd_MMClass     = jQuery('#bd-MobileSiderbar');

        if( jQuery(".bd-ClickOpen").hasClass( "bd-ClickAOpen" ) ) {
            bd_page.css( {overflow:"hidden"} );
            bd_body.addClass( 'js-nav' );
            bd_MMClass.addClass( 'bd-MobileSiderbarShow' );
            jQuery(this).removeClass('bd-ClickAOpen').addClass('bd-ClickAClose');
            return false;
        }
        else if( jQuery(".bd-ClickOpen").hasClass( "bd-ClickAClose" ) ) {
            bd_page.css({overflow:"auto"});
            bd_body.removeClass( 'js-nav' );
            bd_MMClass.removeClass( 'bd-MobileSiderbarShow' );
            jQuery(this).removeClass('bd-ClickAClose').addClass('bd-ClickAOpen');
            return false;
        }
    });

    var mobileItems = jQuery( '.bdaia-header-default #navigation .primary-menu' ).clone();
    mobileItems.find( '.sub_cats_posts .mega-menu-content, .nav-logo, .logo' ).remove();
    jQuery( '#bd-MobileSiderbar #mobile-menu' ).append( mobileItems );

    if( aia.config.mobile_topmenu ) {
        var mobileItemsTop = jQuery( '.bdaia-header-default .topbar ul.top-nav' ).clone();
        jQuery( '#bd-MobileSiderbar #mobile-menu' ).append( mobileItemsTop );
    }

    // Add Mobile Menu item icon
    jQuery( "#bd-MobileSiderbar #mobile-menu .menu-item-has-children" ).append( '<span class="mobile-arrows bdaia-io bdaia-io-menu"></span>' );
    jQuery(document).on("click", "#mobile-menu .menu-item-has-children .mobile-arrows", function()
    {
        if( jQuery(this).hasClass( "fa-chevron-down" ) ) {
            jQuery(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
        }
        else {
            jQuery(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
        }
        jQuery(this).parent().find('ul:first').toggle();
    });
};;


/**
 * Check also
 * ========================================================= */
;function woohoo_check_also()
{
    var $bdCheckAlso        = jQuery("#bdCheckAlso");
    var $bdCheckAlsoRight  = jQuery(".bdCheckAlso-right");

    if( !bdaia_is_mob.any() && aia.config.is_singular && $bdCheckAlso.length > 0 )
    {
        var articleOffset = jQuery('article.hentry').offset().top + ( jQuery('article.hentry').outerHeight()/2 );
        var bdCheckAlsoClosed = false;

        if( jQuery(window).width() <= 1120 ) {
            $bdCheckAlso.hide()
        }
        else {
            $bdCheckAlso.show()
        }

        jQuery(window).resize(function(){
            if( jQuery(window).width() <= 1120 ){
                $bdCheckAlso.hide()
            }
            else {
                $bdCheckAlso.show()
            }
        });

        jQuery(window).scroll(function() {
            if( ! bdCheckAlsoClosed ) {
                if (jQuery(window).scrollTop() > articleOffset) {
                    if ($bdCheckAlsoRight.length) {
                        $bdCheckAlso.addClass("bdCheckAlsoShow");
                    }
                    else {
                        $bdCheckAlso.addClass("bdCheckAlsoShow");
                    }
                }
                else if (jQuery(window).scrollTop() <= articleOffset) {
                    if ($bdCheckAlsoRight.length) {
                        $bdCheckAlso.removeClass("bdCheckAlsoShow");
                    }
                    else {
                        $bdCheckAlso.removeClass("bdCheckAlsoShow");
                    }
                }
            }
        });

        jQuery("#check-also-close").click(function(){
            $bdCheckAlso.removeClass("bdCheckAlsoShow");
            bdCheckAlsoClosed = true ;
            return false;
        });
    }
};;


/**
 * Reading post bar
 * ========================================================= */
;function woohoo_Reading_post_bar()
{
    if( !bdaia_is_mob.any() && aia.config.is_singular && aia.config.post_reading_position_indicator ) {
        var reading_content = jQuery('.bdMain .post' );
        if( reading_content.length > 0 )
        {
            reading_content.imagesLoaded(function()
            {
                var content_height	= reading_content.height();
                window_height	= jQuery(window).height();
                jQuery(window).scroll(function() {
                    var percent 		= 0,
                        content_offset	= reading_content.offset().top;
                    window_offest	= jQuery(window).scrollTop();

                    if (window_offest > content_offset) {
                        percent = 100 * (window_offest - content_offset) / (content_height - window_height);
                    }
                    jQuery('#reading-position-indicator').css('width', percent + '%');
                });
            });
        }
    }
};;


/**
 * Youtube z-index fix
 * ========================================================= */
;function woohoo_youtube_zindex()
{
    jQuery('iframe[src*="youtube.com"]').each(function() {
        var url = jQuery(this).attr('src');
        if (jQuery(this).attr('src').indexOf('?') > 0) {
            jQuery(this).attr({
                'src'   : url + '&wmode=transparent',
                'wmode' : 'Opaque'
            });
        } else {
            jQuery(this).attr({
                'src'   : url + '?wmode=transparent',
                'wmode' : 'Opaque'
            });
        }
    });
};;


/**
 * Sticky navigation
 * ========================================================= */
;function woohoo_sticky_nav()
{
    var stickySidebarTop = 0;
    if ( !bdaia_is_mob.any() )
    {
        if ( jQuery(window).width() > 1000 )
        {
            if ( jQuery( '.page-outer' ).hasClass( 'sticky-nav-on' ) )
            {
                var bd_nav          = jQuery('#navigation');
                var bd_wpadminbar   = jQuery('#wpadminbar');

                if ( bd_wpadminbar.length ) {
                    stickySidebarTop = 32;
                }
                else {
                    stickySidebarTop = 0;
                }

                var bd_above_Height = jQuery('.bdaia-header-default .header-container').outerHeight();

                jQuery(window).scroll(function ()
                {
                    if (jQuery(window).scrollTop() > bd_above_Height)
                    {
                        bd_nav.addClass('sticky-nav').css('top', stickySidebarTop );
                    }
                    else {
                        bd_nav.removeClass('sticky-nav').css('top', '0');
                    }
                });

            }
        }
    }
};;


/**
 * Title tip
 * ========================================================= */
;function woohoo_ttip()
{
    jQuery('.ttip').tipsy({fade: true, gravity: 's'});
    jQuery('.tooldown, .tooltip-s').tipsy({fade: true, gravity: 'n'});
    jQuery('.tooltip-nw').tipsy({fade: true, gravity: 'nw'});
    jQuery('.tooltip-ne').tipsy({fade: true, gravity: 'ne'});
    jQuery('.tooltip-w').tipsy({fade: true, gravity: 'w'});
    jQuery('.tooltip-e').tipsy({fade: true, gravity: 'e'});
    jQuery('.tooltip-sw').tipsy({fade: true, gravity: 'w'});
    jQuery('.tooltip-se').tipsy({fade: true, gravity: 'e'});
};;


/**
 * Sticky sidebar
 * ========================================================= */

;function woohoo_sticky_sidebar()
{
    if ( !bdaia_is_mob.any() && aia.config.sticky_sidebar ) {
        jQuery( '.theia_sticky' ).theiaStickySidebar({
            "containerSelector"     :".bd-main",
            "additionalMarginTop"   : 32,
            'minWidth'               : 990
        });
    }
};;


/**
 * Set min height
 * ========================================================= */
;function woohoo_setHeight()
{
    var windowHeight = jQuery(".bd-sidebar").innerHeight();
    jQuery(".bd-main").css('min-height', windowHeight);

    var psbigHeight = jQuery(".bdaia-blocks .nip-pssmall").innerHeight();
    jQuery(".bdaia-blocks .nip-psbig").css('max-height', psbigHeight);

};;


/**
 * Images Scroll
 * ========================================================= */
;function woohoo_on_scroll()
{
    var scrolled            = jQuery(window).scrollTop();
    var win_height_padded   = jQuery(window).height() * .9;

    jQuery( ".bdaia-lazyload .post-thumb, .bdaia-lazyload .block-article-img-container, .bdaia-lazyload .bdaia-fp-post-img-container, .bdaia-lazyload .big-grids, .bdaia-lazyload .bd-post-carousel, .bdaia-lazyload .post-image, .bdaia-lazyload .bdaia-post-featured-image, .bdaia-lazyload .bdaia-post-content img, .bdaia-lazyload .bd-block-mega-menu-post, .bdaia-lazyload .bdaia-featured-img-cover, .bdaia-lazyload .thumbnail-cover, .bdaia-lazyload .ei-slider, .bdaia-lazyload .bd-post-thumb, .bdaia-lazyload .bwb-article-img-container" ).each(function (){
        var thiss     = jQuery(this);
        var offsetTop = thiss.offset().top;

        if (scrolled + win_height_padded > offsetTop) {
            jQuery(this).addClass( 'bdaia-img-show' );
        }
    });
};;


/**
 * Post like
 * ========================================================= */
;function woohoo_post_like()
{
    jQuery(document).on('click', '.post-like a' , function () {
        heart   = jQuery(this);
        post_id = heart.data( "post_id" );
        jQuery.ajax({
            type    : "post",
            url     : userLike.ajaxurl,
            data    : "action=woohoo_post_like&nonce="+userLike.nonce+"&bdaia_post_like=&post_id="+post_id,
            success: function(e) {
                if (e != "already") {
                    heart.addClass("voted");
                    heart.siblings(".count").text(e)
                }
            }
        }); return false
    });
};;

(function($, window, undefined) {
    // http://paulirish.com/2011/requestanimationframe-for-smart-animating/
    // http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating

    // requestAnimationFrame polyfill by Erik Möller
    // fixes from Paul Irish and Tino Zijdel

    var lastTime = 0,
        running,
        animate = function (elem) {
            if (running) {
                window.requestAnimationFrame(animate, elem);
                jQuery.fx.tick();
            }
        },
        vendors = ['ms', 'moz', 'webkit', 'o'];

    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame']
            || window[vendors[x]+'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(fn, element) {
            var currTime = new Date().getTime(),
                delta = currTime - lastTime,
                timeToCall = Math.max(0, 16 - delta);

            var id = window.setTimeout(function() {
                    fn(currTime + timeToCall);
                },
                timeToCall
            );

            lastTime = currTime + timeToCall;

            return id;
        };

    if (!window.cancelAnimationFrame) {
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
    }

    jQuery.fx.timer = function (timer) {
        if (timer() && jQuery.timers.push(timer) && !running) {
            running = true;
            animate(timer.elem);
        }
    };

    jQuery.fx.stop = function() {
        running = false;
    };

}(jQuery, this));