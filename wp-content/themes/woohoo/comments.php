<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() )
{
	?><p class="no-comments"><?php echo woohoo_lang_tt('This post is password protected. Enter the password to view comments.', 'woohoo'); ?></p><?php
	return;
}

if ( have_comments() ) :
	?>
	<div id="comments" class="comments-container">
		<h4 class="block-title"><span><?php comments_number( woohoo_lang_tt( 'No Comments', 'woohoo' ), woohoo_lang_tt( 'One Comment', 'woohoo' ), '% ' . woohoo_lang_tt( 'Comments', 'woohoo' ) ); ?></span></h4>
		<ol class="commentlist">
			<?php wp_list_comments('callback=woohoo_comment'); ?>
		</ol>
		<div class="comments-navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
	</div>
	<?php
else :
	if ( comments_open() ) :
	else :
		?><p class="no-comments"><?php echo woohoo_lang_tt( 'Comments are closed.', 'woohoo' ); ?></p><?php
	endif;
endif;

comment_form();