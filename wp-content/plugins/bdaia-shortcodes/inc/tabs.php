<?php
function bdaia_shorty_tabs( $atts, $content = null, $code )
{
	$type = '';

	if( is_array( $atts ) ) extract($atts);

	$class = 'horizontal-tabs';
	if( $type == "vertical" ) $class = 'vertical-tabs';

	$out ='<div><script type="text/javascript">jQuery(document).ready(function($){jQuery("ul.nav-tabs").tabs(".tab-content > .tab-pane"); });</script></div><div class="bdaia-tabs '.$class.'">'.do_shortcode($content).'</div></div>';
	return $out;
}
add_shortcode('tabs', 'bdaia_shorty_tabs');
function bdaia_shorty_tab( $atts, $content = null, $code )
{
	$out ='<div class="tab-pane">'.do_shortcode($content).'</div>';
	return $out;
}
add_shortcode('tab', 'bdaia_shorty_tab');
function bdaia_shorty_tabs_head( $atts, $content = null, $code )
{
	$out ='<ul class="nav-tabs">'.do_shortcode($content).'</ul><div class="tab-content">';
	return $out;
}
add_shortcode('tabs_head', 'bdaia_shorty_tabs_head');
function bdaia_shorty_tab_title( $atts, $content = null, $code )
{
	$out ='<li><span>'.do_shortcode($content).'</span></li>';
	return $out;
}
add_shortcode('tab_title', 'bdaia_shorty_tab_title');
