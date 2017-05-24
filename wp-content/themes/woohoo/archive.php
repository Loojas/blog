<?php get_header(); ?>
	<div class="bdaia-home-container">
		<div class="bd-container">
			<div class="bd-main">
				<?php
				$GLOBALS['template_layout'] = woohoo_get_option( 'archive_blog_display' );
				$woohoo_block_title = "";
				if( !empty( $GLOBALS['template_layout'] ) && $GLOBALS['template_layout'] == 'blockStyle2' || !empty( $GLOBALS['template_layout'] ) && $GLOBALS['template_layout'] == 'blockStyle6' ) {
					$woohoo_block_title = ' bdaia-block-nt';
				}
				?>
				<div class="cfix"></div>
				<div class="bdaia-block-wrap<?php echo $woohoo_block_title; ?>">
					<?php if ( have_posts() ): the_post(); ?>
						<h4 class="block-title">
							<span>
								<?php if ( is_day() ) : ?>
									<?php printf( woohoo_lang_tt( 'Daily Archives: %s', 'woohoo' ), get_the_date() ); ?>
								<?php elseif ( is_month() ) : ?>
									<?php printf( woohoo_lang_tt( 'Monthly Archives: %s', 'woohoo' ), get_the_date( 'F Y' ) ); ?>
								<?php elseif ( is_year() ) : ?>
									<?php printf( woohoo_lang_tt( 'Yearly Archives: %s', 'woohoo' ), get_the_date( 'Y' ) ); ?>
								<?php else : ?>
									<?php woohoo_lang_tt( 'Blog Archives', 'woohoo' ); ?>
								<?php endif; ?>
							</span>
						</h4>
					<?php endif; ?>
					<?php
					// Start loop.
					rewind_posts();
					get_template_part( 'loop-template' );
					?>
					<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) woohoo_page_nav(); wp_reset_query(); ?>
				</div><!--/END Wrap/-->
			</div>
			<?php get_sidebar(); // END Sidebar. ?>
		</div>
	</div><!-- END Home Container. -->
<?php get_footer(); ?>