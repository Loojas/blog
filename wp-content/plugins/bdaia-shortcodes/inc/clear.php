<?php
function bdaia_shorty_clear( $atts, $content, $code ) {
	return '<div class="clear-fix"></div>';
}
add_shortcode( 'clear', 'bdaia_shorty_clear' );