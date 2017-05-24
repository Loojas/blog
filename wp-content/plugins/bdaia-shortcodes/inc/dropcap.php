<?php
function bdaia_shorty_dropcap( $atts, $content, $code )
{
	$stylecss = $bgcolor = $txtcolor = $style = "";

	if( is_array( $atts ) ) extract( $atts );

	if( ! empty( $style ) ) $style = ' bdaia-shory-'.$style;

	if( !empty( $bgcolor ) || !empty( $txtcolor ) )
	{
		$stylecss = 'style="';
		if( !empty( $bgcolor  )  ) $stylecss .= 'background:'.$bgcolor.';';
		if( !empty( $txtcolor )  ) $stylecss .= 'color:'.$txtcolor.';';
		$stylecss .= '"';
	}

	return '<span class="bdaia-shory-'.$code. $style.'" '.$stylecss.'>'.do_shortcode($content).'</span>';

}
add_shortcode( 'dropcap', 'bdaia_shorty_dropcap' );