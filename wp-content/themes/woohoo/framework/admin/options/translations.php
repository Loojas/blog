<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$bd_options["translations"]['translations'][] = array(
	"name" 		=> "Translations",
	"type"  	=> "subtitle"
);

require_once ( get_template_directory() . '/framework/admin/framework-default-texts.php' );
$woohoo_default_texts = $GLOBALS['woohoo_default_texts'];

if( is_array($woohoo_default_texts) ) {
	foreach ( $woohoo_default_texts as $value )
	{
		$value = htmlspecialchars( $value );
		$bd_options["translations"]['translations'][] = array(
			"name" => $value,
			"id"   => woohoo_sanitize_title( $value ),
			"type" => "text"
		);
	}
}