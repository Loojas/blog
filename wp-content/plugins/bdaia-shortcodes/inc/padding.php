<?php
function bdaia_shorty_padding( $atts, $content, $code )
{
	$left = $right = "";

	if( is_array( $atts ) ) extract($atts);

	$stylecss = "";
	if( !empty( $left ) || !empty( $right ) ) {
		$stylecss = 'style="';
		if( !empty( $left  )  ) $stylecss .= 'padding-left:'.$left.'!important;';
		if( !empty( $right )  ) $stylecss .= 'padding-right:'.$right.'!important;';
		$stylecss .= '"';
	}

	return '<p class="bdaia-'.$code.'"'.$stylecss.'>'. do_shortcode( $content ) .'</p>';
}
add_shortcode( 'padding', 'bdaia_shorty_padding' );