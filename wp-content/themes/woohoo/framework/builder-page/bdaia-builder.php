<?php
/**
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Woohoo News Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

add_action('save_post', 'woohoo_save_builder_p');
function woohoo_save_builder_p( $post_id )
{
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( isset( $_POST['bdaia_builder_p_active'] ) && !empty( $_POST['bdaia_builder_p_active'] ) && $_POST['bdaia_builder_p_active'] == 'yes' ) {
		update_post_meta( $post_id, 'bdaia_builder_p_active' , 'yes' );
	}
	else {
		delete_post_meta( $post_id, 'bdaia_builder_p_active' );
	}

	// Home Cat.
	if( isset( $_POST['bdaia_home_cats'] ) && !empty( $_POST['bdaia_home_cats'] ) )
	{
		array_walk_recursive( $_POST['bdaia_home_cats'] , 'woohoo_c_settings');
		update_post_meta( $post_id, 'bdaia_builder_page' , $_POST[ 'bdaia_home_cats' ] );
	}
	else {
		delete_post_meta( $post_id, 'bdaia_builder_page' );
	}


	// Home Post Carousel.
	if( isset( $_POST['bdaia_pc'] ) && !empty( $_POST['bdaia_pc'] ) )
	{
		array_walk_recursive( $_POST['bdaia_pc'] , 'woohoo_c_settings');
		update_post_meta( $post_id, 'bdaia_builder_page_pc' , $_POST[ 'bdaia_pc' ] );
	}
	else {
		delete_post_meta( $post_id, 'bdaia_builder_page_pc' );
	}

	// Home Feature Posts.
	if( isset( $_POST['bdaia_fp'] ) && !empty( $_POST['bdaia_fp'] ) )
	{
		array_walk_recursive( $_POST['bdaia_fp'] , 'woohoo_c_settings');
		update_post_meta( $post_id, 'bdaia_builder_page_fp' , $_POST[ 'bdaia_fp' ] );
	}
	else {
		delete_post_meta( $post_id, 'bdaia_builder_page_fp' );
	}

	// Home Block Options.
	if( isset( $_POST['bdaia_bo'] ) && !empty( $_POST['bdaia_bo'] ) )
	{
		array_walk_recursive( $_POST['bdaia_bo'] , 'woohoo_c_settings');
		update_post_meta( $post_id, 'bdaia_bp_block_options' , $_POST[ 'bdaia_bo' ] );
	}
	else {
		delete_post_meta( $post_id, 'bdaia_bp_block_options' );
	}
}

add_action( 'edit_form_after_title', 'woohoo_builder_p' );
function woohoo_builder_p()
{
	global $post, $wp_cats;
	$builder_active = false;
	$screen = get_current_screen();

	if( get_post_type ( get_the_ID() ) != 'page' || $screen->post_type != 'page' )	{
		return;
	}

	// GET Categories.
	echo '<select id="bd_cats" style="display:none;">';
	echo '<option value="" selected="selected">- All categories -</option>';
	foreach($wp_cats as $c_id => $c_name ) {
		echo '<option value="'. $c_id .'">'. $c_name .'</option>';
	}
	echo '</select>';

	// GET Custom Post Type.
	$meta_GET = get_post_custom( get_the_ID() );

	if( isset( $meta_GET[ 'bdaia_builder_page' ][0] ) )
	{
		$bdaia_bp = false;
		if( !empty( $meta_GET[ 'bdaia_builder_page' ][0] ) )
		{
			$bdaia_bp = $meta_GET[ 'bdaia_builder_page' ][0];
			if( is_serialized( $bdaia_bp ) )
				$bdaia_bp = unserialize ( $bdaia_bp );
		}
	}

	$bdaia_bp_pc = "";
	if( isset( $meta_GET[ 'bdaia_builder_page_pc' ][0] ) )
	{
		$bdaia_bp_pc = false;
		if( !empty( $meta_GET[ 'bdaia_builder_page_pc' ][0] ) )
		{
			$bdaia_bp_pc = $meta_GET[ 'bdaia_builder_page_pc' ][0];
			if( is_serialized( $bdaia_bp_pc ) )
				$bdaia_bp_pc = unserialize ( $bdaia_bp_pc );
		}
	}

	$bdaia_bp_fp = "";
	if( isset( $meta_GET[ 'bdaia_builder_page_fp' ][0] ) )
	{
		$bdaia_bp_fp = false;
		if( !empty( $meta_GET[ 'bdaia_builder_page_fp' ][0] ) )
		{
			$bdaia_bp_fp = $meta_GET[ 'bdaia_builder_page_fp' ][0];
			if( is_serialized( $bdaia_bp_fp ) )
				$bdaia_bp_fp = unserialize ( $bdaia_bp_fp );
		}
	}

	$bdaia_bp_bo = "";
	if( isset( $meta_GET[ 'bdaia_bp_block_options' ][0] ) )
	{
		$bdaia_bp_bo = false;
		if( !empty( $meta_GET[ 'bdaia_bp_block_options' ][0] ) )
		{
			$bdaia_bp_bo = $meta_GET[ 'bdaia_bp_block_options' ][0];
			if( is_serialized( $bdaia_bp_bo ) )
				$bdaia_bp_bo = unserialize ( $bdaia_bp_bo );
		}
	}

	if(  !empty( $meta_GET[ 'bdaia_builder_p_active' ][0] ) ) $builder_active = 'yes' ;
	?>
	<a class="bdaia_builder_go <?php if( !empty( $builder_active ) ) echo ' bdaia_builder_go_active'?>" href="" id="bdaia_page_builder">Page Builder</a>
	<input type="hidden" id="bdaia_builder_p_active" name="bdaia_builder_p_active" value="<?php echo $builder_active ?>">
	<script type="text/javascript">
	jQuery(function() {
		jQuery( ".bdaia_boxes_sortable" ).sortable({
			placeholder: "ui-state-highlight",
			connectWith: ".bdaia_boxes_sortable",
			start: function(e, ui){
				ui.placeholder.height(ui.item.height());
			}
		});
	});
	</script>
	<?php
	//GET.
	require_once ( get_template_directory().'/framework/builder-page/inc/pb-blocks.php' );
	require_once ( get_template_directory().'/framework/builder-page/inc/pb-blog.php' );
	require_once ( get_template_directory().'/framework/builder-page/inc/pb-slider.php' );
	require_once ( get_template_directory().'/framework/builder-page/inc/pb-text.php' );
	require_once ( get_template_directory().'/framework/builder-page/inc/pb-fp.php' );
	require_once ( get_template_directory().'/framework/builder-page/inc/pb-pc.php' );
	require_once ( get_template_directory().'/framework/builder-page/inc/pb-bo.php' );
	?>
	<div id="bdaia_home_builder" <?php if( !empty( $builder_active ) ) echo ' style="display:block;"'?>>
		<div class="meta-box-sortables ui-sortable">
			<div class="postbox">
				<h3 style="border-bottom: 1px solid #eee !important; cursor: default !important;"><span>Bdaia Page Builder</span></h3>
				<div class="inside">

					<ul class="box_layout_list bdaia_home_builder_nav">
						<li><a href="#" id="bdaia_home_block1_btn" title="Add News Box - Block 1"><span class="layout-img block-1"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_block2_btn" title="Add News Box - Block 2"><span class="layout-img block-2"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_block13_btn" title="Add News Box - Block 13"><span class="layout-img block-22"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_block3_btn" title="Add News Box - Block 3"><span class="layout-img block-3"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_block4_btn" title="Add News Box - Block 4"><span class="layout-img block-4"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_block5_btn" title="Add News Box - Block 5"><span class="layout-img block-5"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_block6_btn" title="Add News Box - Block 6"><span class="layout-img block-6"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_block7_btn" title="Add News Box - Block 7"><span class="layout-img block-7"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_block23_btn" title="Add News In Pic"><span class="layout-img block-23"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_block24_btn" title="Add News In Pic Grid"><span class="layout-img block-24"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_block8_btn" title="Add News Box - Block 8"><span class="layout-img block-8"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_block9_btn" title="Add News Box - Block 9"><span class="layout-img block-9"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_block10_btn" title="Add News Box - Block 10"><span class="layout-img block-10"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_block11_btn" title="Add News Box - Block 11"><span class="layout-img block-11"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_block12_btn" title="Add News Box - Timeline"><span class="layout-img block-12"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_slider_btn" title="Add Slider"><span class="layout-img block-slider"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_blog_btn" title="Add A Blog"><span class="layout-img block-blog"><i></i></span></a></li>
						<li><a href="#" id="bdaia_home_ad_btn" title="Add HTML&CODE"><span class="layout-img block-code"><i></i></span></a></li>
					</ul>

					<div class="bdaia_boxes_sortable">
						<?php
						if( isset( $bdaia_bp ) and count( $bdaia_bp ) > 0 )
						{
							foreach( $bdaia_bp as $k => $v )
							{
								switch($v['type'])
								{
									case "block1":
										woohoo_pb_block( $k,$v,'block1' );
										break;

									case "block2":
										woohoo_pb_block( $k,$v,'block2' );
										break;

									case "block13":
										woohoo_pb_block( $k,$v,'block13' );
										break;

									case "block3":
										woohoo_pb_block( $k,$v,'block3' );
										break;

									case "block4":
										woohoo_pb_block( $k,$v,'block4' );
										break;

									case "block5":
										woohoo_pb_block( $k,$v,'block5' );
										break;

									case "block6":
										woohoo_pb_block( $k,$v,'block6' );
										break;

									case "block7":
										woohoo_pb_block( $k,$v,'block7' );
										break;

									case "block8":
										woohoo_pb_block( $k,$v,'block8' );
										break;

									case "block9":
										woohoo_pb_block( $k,$v,'block9' );
										break;

									case "block10":
										woohoo_pb_block( $k,$v,'block10');
										break;

									case "block11":
										woohoo_pb_block( $k,$v,'block11');
										break;

									case "block12":
										woohoo_pb_block( $k,$v,'block12');
										break;

									case "block23":
										woohoo_pb_block( $k,$v,'block23');
										break;

									case "block24":
										woohoo_pb_block( $k,$v,'block24');
										break;

									case "blog":
										woohoo_pb_blog( $k,$v,'blog');
										break;

									case "slider":
										woohoo_pb_slider( $k,$v,'slider');
										break;

									case "ad":
										woohoo_pb_text( $k,$v,'ad');
										break;
								}
							}
						}
						?>
					</div>

					<script><?php if( isset ( $bdaia_bp ) ) { ?>var total_boxes = <?php if( is_array( $bdaia_bp ) ){ echo max( array_keys( $bdaia_bp ) ) + 1; } else { echo 1; } ?>;<?php } else { ?>var total_boxes = 1;<?php } ?></script>
				</div>
			</div>

			<?php
			woohoo_pb_bo( $bdaia_bp_bo );
			woohoo_pb_fp( $bdaia_bp_fp );
			woohoo_pb_pc( $bdaia_bp_pc );
			?>
		</div>

	</div>
	<?php
}

//Tinymce.
function woohoo_tinymce_script()
{
	global $pagenow, $typenow;
	if ( empty( $typenow ) && !empty( $_GET['post'] ) )
	{
		$post       = get_post( $_GET['post'] );
		$typenow    = $post->post_type;
	}

	if ( $pagenow=='post-new.php' OR $pagenow=='post.php' OR $pagenow=='admin.php' )
	{
		$cats       = get_terms( "category" );
		$tags       = get_terms( "post_tag" );

		if ( $pagenow=='post-new.php' OR $pagenow=='post.php' ) {
			$the_id = get_the_ID();
		}

		else {
			$the_id = '';
		}
		?>
		<script type="text/javascript">
			post_id         = '<?php echo $the_id; ?>';
			templat_url     = '<?php echo get_template_directory_uri(); ?>';
			$cats           = '<?php
			        echo '<option value="">- All categories -</option>';
			        foreach ( $cats as $cat ) {
			            echo '<option value="'.$cat->slug.'">' . esc_attr($cat->name) . '</option>';
			        }
				?>';
			$tags = '<?php
			        echo '<option value="">- All tags -</option>';
			        foreach ( $tags as $tag ) {
			            echo '<option value="'.$tag->slug.'">' . esc_attr($tag->name) . '</option>';
			        }
				?>';
		</script>
		<?php
	}
}
add_action( 'in_admin_footer', 'woohoo_tinymce_script' );