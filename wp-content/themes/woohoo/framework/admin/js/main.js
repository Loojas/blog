jQuery(document).ready(function()
{
    /*-----------------------------------------------------------------------------------*/
    // preventDefault
    /*-----------------------------------------------------------------------------------*/
    jQuery( ".bd-subtitle.fadeToggle, .bd_box_layout li a, .layouts-inner li a, .bd_box_layout a" ).click(function(event) {
        event.preventDefault(event);
    });

    /*-----------------------------------------------------------------------------------*/
    // fadeToggle
    /*-----------------------------------------------------------------------------------*/
    jQuery(document).on("click", ".bd-subtitle.fadeToggle" , function(){
        var elm_id = jQuery(this).parent().attr('id');
        if(jQuery('#'+elm_id).find('.fadeToggle').hasClass( 'on' )){
            jQuery('#'+elm_id).find('.fadeToggle').removeClass( "on" );
        } else {
            jQuery('#'+elm_id).find('.fadeToggle').addClass( "on" );
        }
    });

    /*-----------------------------------------------------------------------------------*/
    // boxes_title
    /*-----------------------------------------------------------------------------------*/
    jQuery(document).on("click", ".boxes_title" , function(){
        var elm_id = jQuery(this).parent().attr('id');
        if(jQuery('#'+elm_id).find('.bd_item_content').hasClass( 'on' )) {
            jQuery('#'+elm_id).find('.bd_item_content').removeClass( "on" );
            jQuery('#'+elm_id).find('.bd_item_content').addClass( "of" );
        } else {
            jQuery('#'+elm_id).find('.bd_item_content').addClass( "on" );
            jQuery('#'+elm_id).find('.bd_item_content').removeClass( "of" );
        }
    });

    /*-----------------------------------------------------------------------------------*/
    // bd_box_layout
    /*-----------------------------------------------------------------------------------*/
    jQuery(document).on("click", ".bd_box_layout li" , function(){
        jQuery(this).parent('ul').find('li').removeClass('selectd');
        jQuery(this).addClass('selectd');
        jQuery(this).parent('ul').find('input').removeAttr('checked');
        jQuery(this).find('input').attr('checked','checked');
        return false;
    });

    /*-----------------------------------------------------------------------------------*/
    // Panel tabs
    /*-----------------------------------------------------------------------------------*/
    jQuery(".box_tabs_container").hide();
    jQuery("#bd-panel-tabs li:first").addClass("active").show();
    jQuery(".box_tabs_container:first").show();
    jQuery("#bd-panel-tabs li").click(function() {
        jQuery("#bd-panel-tabs li").removeClass("active");
        jQuery(this).addClass("active");
        jQuery(".box_tabs_container").hide();
        var active = jQuery(this).find("a").attr("href");
        jQuery(active).fadeIn('fast');
        return false;
    });
});