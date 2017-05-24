<?php
function bdaia_shorty_highlight( $atts, $content, $code )
{
	$bgcolor = $txtcolor = "";

	if( is_array( $atts ) ) extract( $atts );

	$style ='';
	if( !empty( $bgcolor ) || !empty( $txtcolor ) )
	{
		$style = 'style="';
		if( !empty( $bgcolor  )  ) $style .= 'background:'.$bgcolor.';';
		if( !empty( $txtcolor )  ) $style .= 'color:'.$txtcolor.';';
		$style .= '"';
	}

	return '<span class="bdaia-shory-'.$code.'" '.$style.'>'.do_shortcode($content).'</span>';
}
add_shortcode( 'highlight', 'bdaia_shorty_highlight' );