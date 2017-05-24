<?php
function bdaia_shorty_lists( $atts, $content = null, $code )
{
	$sio_type = $sio_style = $s = $t = $list_items = $io_type = $sio_css = $sio_cio = '';

	if( is_array( $atts ) ) extract($atts);

	if( !empty( $sio_style ) ) $s = ' s-'.$sio_style;
	if( !empty( $sio_type ) ) $t = ' t-'.$sio_type;

	if( $sio_type == "star" ) $io_type = " bdaia-sio-star";
	elseif( $sio_type == "check" ) $io_type = " bdaia-sio-check-square-o2";
	elseif( $sio_type == "like" ) $io_type = " bdaia-sio-thumbs-up";
	elseif( $sio_type == "dislike" ) $io_type = " bdaia-sio-thumbs-down";
	elseif( $sio_type == "asterisk" ) $io_type = " bdaia-sio-asterisk";
	elseif( $sio_type == "plus" ) $io_type = " bdaia-sio-plus-square-o";
	elseif( $sio_type == "minus" ) $io_type = " bdaia-sio-minus-square-o";
	elseif( $sio_type == "angle" ) {
		if ( is_rtl() ) $io_type = " bdaia-sio-angle-left";
		else $io_type = " bdaia-sio-angle-right";
	}
	elseif( $sio_type == "heart" ) $io_type = " bdaia-sio-heart";
	elseif( $sio_type == "denied" ) $io_type = " bdaia-sio-denied";
	elseif( $sio_type == "idea" ) $io_type = " bdaia-sio-light-bulb";
	elseif( $sio_type == "cross" ) $io_type = " bdaia-sio-cross";
	elseif( $sio_type == "files" ) $io_type = " bdaia-sio-file-text";
	elseif( $sio_type == "notification" ) $io_type = " bdaia-sio-notification";
	elseif( $sio_type == "paint" ) $io_type = " bdaia-sio-paint-brush";
	elseif( $sio_type == "edit" ) $io_type = " bdaia-sio-edit";
	elseif( $sio_cio ) $io_type = " ".$sio_cio;


	if( !empty( $sio_bgcolor ) || !empty( $sio_txtcolor ) )
	{
		$sio_css = 'style="';
		if( $sio_style == "circles" || $sio_style == "square" ){
			if( !empty( $sio_bgcolor  )  ) $sio_css .= 'background:'.$sio_bgcolor.' !important;';
		}
		if( !empty( $sio_txtcolor )  ) $sio_css .= 'color:'.$sio_txtcolor.' !important;';
		$sio_css .= '"';
	}


	if ( $list_items == '' ) $list_items = $content;
	$list_items = explode(',', $list_items);

	$output      = '<div class="bdaia-'.$code . $s . $t .'"><ul>';
	foreach( $list_items as $li )
	{
		$output .= '<li><span class="bdaia-sio'.$io_type.'" '.$sio_css.'></span><span class="txt">'.trim($li).'</span></li>';
	}
	$output     .= '</ul></div>';
	return $output;
}
add_shortcode( 'lists', 'bdaia_shorty_lists' );
