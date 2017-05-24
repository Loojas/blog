<div class="wrap" id="ilightbox_admin_wrap">
	<div class="ilightbox_admin_content clearfix">
	<?php require_once('ilightbox_menu.php');?>
			<form method="post" class="ajaxform">
				<div class="ilightbox_topbar clearfix">
					<a class="il-button lightblue-button" role="submit"><span>Import</span></a>
					<h3>Import/Export</h3>
				</div>
				
				<input type="hidden" name="_action" value="import" />
				<div class="row margintop clearfix">
					<ul class="item_listing">
						<li class="col span_1">
							<div class="section clearfix">
								<h3 class="title">Import</h3>
								<div class="description">Insert your export code here to import it.</div>
								<textarea rows="10" name="import_code"></textarea>
							</div>
						</li>
						<li class="col span_1">
							<div class="section clearfix">
								<h3 class="title">Export</h3>
								<div class="description">Export code</div>
<?php
	$export = array();
	$export['upload_dir'] = wp_upload_dir();
	$export['options'] = array();
	$export['options']['ilightbox_added_galleries'] = $this->get_option('ilightbox_added_galleries');
	$export['options']['ilightbox_jetpack'] = $this->get_option('ilightbox_jetpack');
	$export['options']['ilightbox_nextgen'] = $this->get_option('ilightbox_nextgen');
	$export['options']['ilightbox_bindeds'] = $this->get_option('ilightbox_bindeds');
	$export['options']['ilightbox_auto_enable'] = $this->get_option('ilightbox_auto_enable');
	$export['options']['ilightbox_auto_enable_videos'] = $this->get_option('ilightbox_auto_enable_videos');
	$export['options']['ilightbox_auto_enable_video_sites'] = $this->get_option('ilightbox_auto_enable_video_sites');
	$export['options']['ilightbox_gallery_shortcode'] = $this->get_option('ilightbox_gallery_shortcode');
	$export['options']['ilightbox_global_options'] = $this->get_option('ilightbox_global_options');
	$export['options']['ilightbox_styles'] = $this->get_option('ilightbox_styles');
	$export_code = base64_encode(json_encode($export));
?>
								<textarea rows="10" readonly="readonly" onclick="this.focus();this.select();"><?php echo @$export_code; ?></textarea>
							</div>
						</li>
					</ul> <!-- .item_listing -->
				</div> <!-- .row -->
				
			</form>
		</div>
	</div>
</div><!-- #ilightbox_admin_wrap -->