<?php
global $post;
$original_post      = $post;
$pc_rand            = woohoo_rand(7);
$size               = 'bdaia-carousel';
$meta_GET           = get_post_custom( get_the_ID() );

$home_pc = $display = $pc_posts = $speed = $time = $offset = $num_posts = $cat = $cat_uids = $tag_slug = $sort_order = "";

if( isset( $meta_GET[ 'bdaia_builder_page_pc' ][0] ) )
{
	$home_pc = false;
	if( !empty( $meta_GET[ 'bdaia_builder_page_pc' ][0] ) )
	{
		$home_pc = $meta_GET[ 'bdaia_builder_page_pc' ][0];
		if( is_serialized( $home_pc ) ){
			$home_pc = unserialize ( $home_pc );
		}
	}
}

if( isset( $home_pc['onof'] ) )
	$display            = $home_pc['onof'];

if( isset( $home_pc['posts'] ) )
	$pc_posts           = $home_pc['posts'];

if( isset( $home_pc['speed'] ) )
	$speed              = $home_pc['speed'];

if( isset( $home_pc['animation_speed'] ) )
	$time               = $home_pc['animation_speed'];

if( isset( $home_pc['offset'] ) )
	$offset             = $home_pc['offset'];

if( isset( $home_pc['num_posts'] ) )
	$num_posts          = $home_pc['num_posts'];

if( isset( $home_pc['cat'] ) )
	$cat                = $home_pc['cat'];

if( isset( $home_pc['cat_uids'] ) )
	$cat_uids           = $home_pc['cat_uids'];

if( isset( $home_pc['tag_slug'] ) )
	$tag_slug           = $home_pc['tag_slug'];

if( isset( $home_pc['sort_order'] ) )
	$sort_order         = $home_pc['sort_order'];

if( !$speed || $speed == ' ' || !is_numeric( $speed ) ) $speed = 7000;
if( !$time  || $time  == ' ' || !is_numeric( $time ) ) $time  = 600;

$g_category         = get_category_by_slug( $cat );
$get_term_id = $get_terms_ids = '';
if( !empty( $g_category ) ) {
	$get_term_id    = $g_category->term_id;
}
if( !empty( $cat_uids ) ) {
	$catslugs       = explode( ',', $cat_uids );
	$get_term_ids   = woohoo_get_cats_by_slug( $catslugs );
	$get_terms_ids  = implode( ',', $get_term_ids );
}

if ( !empty( $get_term_id ) and empty( $get_terms_ids ) ) $get_terms_ids = $get_term_id;

if ( !empty( $get_terms_ids ) ) $pc_query_args['cat'] = $get_terms_ids;

if ( !empty( $tag_slug ) ) $pc_query_args['tag'] = str_replace(' ', '-', $tag_slug);

if ( !empty( $pc_posts ) ) $pc_query_args['post__in'] = explode (',' , $pc_posts );

switch ( $sort_order )
{
	case 'popular':
		$pc_query_args['meta_key']      = 'bdaia_views';
		$pc_query_args['orderby']       = 'meta_value_num';
		$pc_query_args['order']         = 'DESC';
		break;

	case 'review_high':
		$pc_query_args['meta_key']      = 'bdaia_taqyeem_final_score';
		$pc_query_args['orderby']       = 'meta_value';
		$pc_query_args['order']         = 'DESC';
		$pc_query_args['meta_value']    = 0;
		$pc_query_args['meta_compare']  = '!=';
		break;

	case 'random_posts':
		$pc_query_args['orderby']       = 'rand';
		break;

	case 'alphabetical_order':
		$pc_query_args['orderby']       = 'title';
		$pc_query_args['order']         = 'ASC';
		break;

	case 'comment_count':
		$pc_query_args['orderby']       = 'comment_count';
		$pc_query_args['order']         = 'DESC';
		break;

	case 'random_today':
		$pc_query_args['orderby']       = 'rand';
		$pc_query_args['year']          = date('Y');
		$pc_query_args['monthnum']      = date('n');
		$pc_query_args['day']           = date('j');
		break;

	case 'random_7_day':
		$pc_query_args['orderby']       = 'rand';
		$pc_query_args['date_query']    = array(
			'column' => 'post_date_gmt',
			'after' => '1 week ago'
		);
		break;
}

$pc_query_args['post_status']       = 'publish';
$pc_query_args['cache_results']     = false;
$pc_query_args[ 'no_found_rows' ]   = true;

if ( empty( $num_posts ) ) $num_posts = 4;
$pc_query_args['posts_per_page'] = $num_posts;

if ( !empty( $offset ) ) $pc_query_args['offset'] = $offset;

if( ! empty( $GLOBALS['woohoo_do_not_diblicate_boxes'] ) && is_array( $GLOBALS['woohoo_do_not_diblicate_boxes'] ) )
{
	$pc_query_args['post__not_in'] = $GLOBALS['woohoo_do_not_diblicate_boxes'];
}

$bdaia_pc_c1 = 1;
$bdaia_pc_c2 = $bdaia_pc_c3 = 0;

$bdaia_pc_query = new WP_Query( $pc_query_args ); ?>

<?php if( $display ) { ?>
	<div class="cfix"></div>
	<div class="bd-container">
		<script>
			jQuery(document).ready(function() {
				jQuery('.bdaia-pc<?php echo $pc_rand; ?>').imagesLoaded(function() {
					jQuery('.bdaia-pc<?php echo $pc_rand; ?>').slick({
						<?php if( is_rtl() ) : ?>
						rtl: true,
						<?php endif;?>
						touchMove      : false,
						speed          : <?php echo $time ?>,
						slide          : 'li',
						autoplay       : true,
						autoplaySpeed  : <?php echo $speed ?>,
						slidesToShow   : 4,
						slidesToScroll : 4,
						infinite       : false,
						arrows         : false,
						dots           : true,
						responsive     : [
							{ breakpoint : 1500, settings : { speed : 500, slide : 'li', slidesToShow : 4, slidesToScroll : 4 } },
							{ breakpoint : 1045, settings : { speed : 500, slide : 'li', slidesToShow : 3, slidesToScroll : 3 } },
							{ breakpoint : 990, settings : { speed : 500, slide : 'li', slidesToShow : 2, slidesToScroll : 2 } },
							{ breakpoint : 900,  settings : { speed : 500, slide : 'li', slidesToShow : 2, slidesToScroll : 2 } },
							{ breakpoint : 730,  settings : { speed : 500, slide : 'li', slidesToShow : 1, slidesToScroll : 1 } },
							{ breakpoint : 670,  settings : { speed : 500, slide : 'li', slidesToShow : 1, slidesToScroll : 1 } },
							{ breakpoint : 500,  settings : { speed : 500, slide : 'li', slidesToShow : 1, slidesToScroll : 1 } },
							{ breakpoint : 350,  settings : { speed : 500, slide : 'li', slidesToShow : 1, slidesToScroll : 1 } }
						]
					});
				});
			});
		</script>
		<ul class="bd-post-carousel unstyled bd-post-carousel-after bdaia-pc<?php echo $pc_rand; ?>">
			<?php
			if ( $bdaia_pc_query->have_posts() ) :
				while ( $bdaia_pc_query->have_posts() ) : $bdaia_pc_query->the_post();
					if( woohoo_get_option( 'woohoo_do_not_duplicate_boxes' ) ) woohoo_do_not_dublicate( get_the_ID() );
					?>
					<li class="bd-post-carousel-item">
						<article>
							<?php echo woohoo_icon_video_play(); ?>
							<a class="img" href="<?php the_permalink(); ?>" <?php if( has_post_thumbnail() ) { ?> style="background-image:url(<?php echo woohoo_thumb_src( $size ); ?>);" <?php } ?>></a>
							<div class="bd-meta-info-container">
								<div class="bd-meta-info-align">
									<div class="bd-meta">
										<div class="featured-cat">
											<?php
											// Get category ------------ ^_^
											echo woohoo_custom_primary_category(); ?>
										</div>
										<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
									</div>

									<div class="bd-meta-info">
										<?php $post_reviews = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true ); ?>
										<?php if( $post_reviews ){ ?>
											<div class="bdaia-post-rating">
												<?php echo woohoo_final_score(); ?>
											</div>
										<?php } else { ?>
											<?php woohoo_get_time(); ?>
										<?php } ?>
									</div>
								</div>
							</div>
						</article>
					</li>
					<?php
				endwhile;
				wp_reset_query();
			endif;
			?>
		</ul>
	</div>
<?php } ?>
<?php $post = $original_post;  ?>
