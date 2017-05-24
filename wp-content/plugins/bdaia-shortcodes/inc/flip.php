<?php
function bdaia_shorty_flip( $atts, $content = null, $code )
{
	$front_content = $back_content = $front_css = $front_bg = $front_txtc = $back_css = $back_bg = $back_txtc = "";

	if( is_array( $atts ) ) extract( $atts );

	if( !empty( $front_bg ) || !empty( $front_txtc ) ) {
		$front_css = ' style="';
		if( !empty( $front_bg  )  ) $front_css .= 'background:'.$front_bg.';';
		if( !empty( $front_txtc )  ) $front_css .= 'color:'.$front_txtc.';';
		$front_css .= '"';
	}

	if( !empty( $back_bg ) || !empty( $back_txtc ) ) {
		$back_css = ' style="';
		if( !empty( $back_bg  )  ) $back_css .= 'background:'.$back_bg.';';
		if( !empty( $back_txtc )  ) $back_css .= 'color:'.$back_txtc.';';
		$back_css .= '"';
	}

	ob_start();
	?>
	<div class="bdaia-flip-container"">
		<div class="bdaia-flipper">
			<div class="bdaia-front"<?php echo $front_css; ?>><div class="bdaia-flip-inner"><?php echo $front_content;?></div></div>
			<div class="bdaia-back"<?php echo $back_css; ?>><div class="bdaia-flip-inner"><?php echo $back_content;?></div></div>
		</div>
	</div>
	<div class="clear-fix"></div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode( 'flip', 'bdaia_shorty_flip' );