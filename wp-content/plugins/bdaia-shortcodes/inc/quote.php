<?php
function bdaia_shorty_quotes( $atts, $content = null, $code )
{
	$quotes_style = $quotes_pos = $bgcolor = $txtcolor = $bqs = $bqpo = "";

	if( is_array( $atts ) ) extract($atts);

	if( $quotes_style == "bqoutes" ) $bqs = " bdaia-bquotes";
	elseif( $quotes_style == "bpull" ) $bqs = " bdaia-bpull";

	if ( $quotes_pos == "left" ) $bqpo = " bdaia-bqpo-left";
	elseif( $quotes_pos == "center" ) $bqpo = " bdaia-bqpo-center";
	elseif( $quotes_pos == "right" ) $bqpo = " bdaia-bqpo-right";

	$output      = '<blockquote class="bdaia-blockquotes'.$bqs.$bqpo.'">';
	$output     .= trim( $content );
	$output     .= '</blockquote>';
	return $output;
}
add_shortcode( 'quotes', 'bdaia_shorty_quotes' );