<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

if ( comments_open() || get_comments_number() )
{
	if( ! woohoo_get_option( 'bdaia_p_commetns_posts_click_btn' ) ) {
		echo "<div class='bdaia-load-comments-btn'>"; comments_popup_link( woohoo_lang_ee( 'Click To Comment' ), '1 ' . woohoo_lang_ee( 'Comment' ), '% ' . woohoo_lang_ee( 'Comments' ) ); echo "</div>";
	}
	
	comments_template();
}
else
{
	echo "<div class='woohoo-comments-closed'>".woohoo_lang_ee( 'Comments are closed.' )."</div>";
}