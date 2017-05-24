<?php
function bdaia_shorty_tooltip( $atts, $content, $code )
{
	$gravity = $text = $txtcolor = $stylecss = "";

	if( is_array( $atts ) ) extract( $atts );

	if( !empty( $txtcolor ) ) {
		$stylecss = 'style="';
		if( !empty( $txtcolor  )  ) $stylecss .= 'color:'.$txtcolor.';';
		$stylecss .= '"';
	}

	return '<span '.$stylecss.' class="bdaia-tooltip tooltip-'.$gravity.'" title="'.$text.'">'.$content.'</span>';
}
add_shortcode( 'tooltip', 'bdaia_shorty_tooltip' );
