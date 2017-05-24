<?php
/*
Plugin Name: Bdaia Shortcodes
Plugin URI: http://themeforest.net/user/bdaia/portfolio
Description: Theme Shortcodes
Author: bdaia
Version: 1.2.0
Author URI: http://themeforest.net/user/bdaia
*/

/**
 * Register and Enquee plugin's styles and scripts ================================= */

function bdaia_shorty_scripts_styles(){
	wp_register_style( 'bdaia_shorty-style' , plugins_url( 'assets/style.css' , __FILE__ ) ) ;
	wp_enqueue_style ( 'bdaia_shorty-style' );
}
add_action( 'init', 'bdaia_shorty_scripts_styles' );

function bdaia_shorty_stylesheet(){
	wp_enqueue_style( 'bdaia_shorty_stylesheet', plugins_url( 'assets/shortcodes.css' , __FILE__ ) );
	wp_register_script('bdaia_shorty_scripts', plugins_url( 'assets/js/scripts.js' , __FILE__ ), array('jquery'));
	wp_register_script('bdaia_shorty_min', plugins_url( 'assets/js/shorty-min.js' , __FILE__ ), array('jquery'));
	wp_enqueue_script('bdaia_shorty_scripts');
	wp_enqueue_script('bdaia_shorty_min');
}
add_action( 'wp_enqueue_scripts', 'bdaia_shorty_stylesheet');

function bdaia_add_footer_styles() {};
add_action( 'get_footer', 'bdaia_add_footer_styles' );

define ( 'bdaia_shorty_js' , plugins_url( 'assets/js/main.js', __FILE__ ) );
define ( 'bdaia_sjs_highlight' , plugins_url( 'assets/js/highlight.js', __FILE__ ) );
define ( 'bdaia_sjs_dropcap' , plugins_url( 'assets/js/dropcap.js', __FILE__ ) );
define ( 'bdaia_sjs_tooltip' , plugins_url( 'assets/js/tooltip.js', __FILE__ ) );
define ( 'bdaia_sjs_lists' , plugins_url( 'assets/js/lists.js', __FILE__ ) );
define ( 'bdaia_sjs_quote' , plugins_url( 'assets/js/quote.js', __FILE__ ) );
define ( 'bdaia_sjs_btn' , plugins_url( 'assets/js/btn.js', __FILE__ ) );
define ( 'bdaia_sjs_flip' , plugins_url( 'assets/js/flip.js', __FILE__ ) );

function bdaia_add_mce_button() {
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'bdaia_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'bdaia_register_mce_button' );
	}
}
add_action('admin_head', 'bdaia_add_mce_button');

function bdaia_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['bdaia_mce_button']   = bdaia_shorty_js;
	$plugin_array['highlight']          = bdaia_sjs_highlight;
	$plugin_array['dropcap']            = bdaia_sjs_dropcap;
	$plugin_array['tooltip']            = bdaia_sjs_tooltip;
	$plugin_array['listss']             = bdaia_sjs_lists;
	$plugin_array['quote']              = bdaia_sjs_quote;
	$plugin_array['btn']                = bdaia_sjs_btn;
	$plugin_array['flip']               = bdaia_sjs_flip;
	return $plugin_array;
}

function bdaia_register_mce_button( $buttons ){
	array_push( $buttons, 'bdaia_mce_button' );
	return $buttons;
}

/**
 * Inc ============================================================================ */

require_once( 'inc/highlight.php'       );
require_once( 'inc/dropcap.php'         );
require_once( 'inc/columns.php'         );
require_once( 'inc/clear.php'           );
require_once( 'inc/divider.php'         );
require_once( 'inc/tooltip.php'         );
require_once( 'inc/padding.php'         );
require_once( 'inc/lists.php'           );
require_once( 'inc/quote.php'           );
require_once( 'inc/btn.php'             );
require_once( 'inc/tabs.php'            );
require_once( 'inc/toggle.php'          );
require_once( 'inc/flip.php'            );

/**
 * Fix ============================================================================ */

add_filter( 'the_content', 'bdaia_shorty_empty_paragraph_fix' );
function bdaia_shorty_empty_paragraph_fix( $content )
{
	$shortcodes = array( 'highlight', 'dropcap', 'raw', 'tooltip', 'lists', 'padding', 'divider', 'btn', 'quotes', 'lists', 'tab', 'tabs', 'tabs_head', 'tab_title', 'toggle', 'masterslider' );

	foreach ( $shortcodes as $shortcode )
	{
		$array = array (
			'<p>[' . $shortcode => '[' .$shortcode,
			'<p>[/' . $shortcode => '[/' .$shortcode,
			$shortcode . ']</p>' => $shortcode . ']',
			$shortcode . ']' => $shortcode . ']'
		);
		$content = strtr( $content, $array );
	}
	return $content;
}

add_filter('the_content', 'bdaia_fix_shortcodes');
function bdaia_fix_shortcodes($content){
	$array = array (
		'[raw]' 		=> '',
		'[/raw]' 		=> '',
		'<p>[raw]' 		=> '',
		'[/raw]</p>' 	=> '',
		'[/raw]<br />' 	=> '',
		'<p>[' 			=> '[',
		']</p>' 		=> ']',
		']<br />' 		=> ']'
	);

	$content = strtr($content, $array);
	return $content;
}

/**
 * adjusted from http://donalmacarthur.com/articles/cleaning-up-wordpress-shortcode-formatting/
 * Clean Up WordPress Shortcode Formatting - important for nested shortcodes ====== */
function bdaia_parse_shortcode_content( $content )
{
	$content = trim( do_shortcode( shortcode_unautop( $content ) ) );

	if ( substr( $content, 0, 4 ) == '' )
		$content = substr( $content, 4 );

	if ( substr( $content, -3, 3 ) == '' )
		$content = substr( $content, 0, -3 );

	$content = str_replace( array( '<p></p>' ), '', $content );
	$content = str_replace( array( '<p>  </p>' ), '', $content );

	return $content;
}

/**
 * Modify excerpts ================================================================= */

function bdaia_modify_post_excerpt( $text = '' )
{
	$raw_excerpt = $text;
	if ( '' == $text )
	{
		$text = get_the_content('');
		$text = apply_filters('bdaia_exclude_content', $text);
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$excerpt_length = apply_filters('excerpt_length', 55);
		$excerpt_more 	= apply_filters('excerpt_more', ' ' . '[&hellip;]');
		$text 			= wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
add_filter( 'get_the_excerpt', 'bdaia_modify_post_excerpt', 9 );

/**
 * Remove Shortcodes code and Keep the content ===================================== */

function bdaia_remove_shortcodes($text = '') {
	$text = preg_replace( '/(\[(padding)\s?.*?\])/' , '' , $text);
	$text = str_replace( array ( '[/padding]', '[dropcap]', '[/dropcap]' ), '', $text);
	return $text;
}
add_filter( 'bdaia_exclude_content', 'bdaia_remove_shortcodes' );