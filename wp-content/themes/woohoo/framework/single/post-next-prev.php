<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>
<div class="bdaia-post-next-prev">
	<div class="bdaia-post-prev-post">
		<?php previous_post_link( '%link', '<span>'. woohoo_lang_ee( 'Previous article' ).'</span> %title' ); ?>
	</div>
	<div class="bdaia-post-next-post">
		<?php next_post_link( '%link', '<span>'. woohoo_lang_ee( 'Next article' ).'</span> %title' ); ?>
	</div>
</div>
<!-- END Previous/Next article. -->