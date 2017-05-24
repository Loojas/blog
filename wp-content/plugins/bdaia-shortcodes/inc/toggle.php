<?php
function bdaia_shorty_toggle( $atts, $content = null, $code )
{
	$type   = 'open';
	$title  = '';

	if( is_array( $atts ) ) extract($atts);

	$out  = '<div class="bdaia-toggle '.$type.'">';
	$out .=     '<h4 class="bdaia-toggle-head toggle-head-open"><span class="bdaia-sio bdaia-sio-angle-up"></span><span class="txt">'.$title.'</span></h4><h4 class="bdaia-toggle-head toggle-head-close"><span class="bdaia-sio bdaia-sio-angle-down"></span><span class="txt">'.$title.'</span></h4>';
	$out .=     '<div class="toggle-content"><p>';
	$out .=         do_shortcode( $content );
	$out .=     '</p></div>';
	$out .= '</div>';

	return $out;
}
add_shortcode('toggle', 'bdaia_shorty_toggle');
