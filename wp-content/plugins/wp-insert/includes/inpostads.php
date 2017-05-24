<?php 
/* Begin Ad Above Post Content */
add_action('wp_ajax_wp_insert_inpostads_above_form_get_content', 'wp_insert_inpostads_above_form_get_content');
function wp_insert_inpostads_above_form_get_content() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');
	wp_insert_inpostads_form_get_content('above');
	die();
}

add_action('wp_ajax_wp_insert_inpostads_above_form_save_action', 'wp_insert_inpostads_above_form_save_action');
function wp_insert_inpostads_above_form_save_action() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');	
	wp_insert_inpostads_form_save_action('above');
	die();
}
/* End Ad Above Post Content */

/* Begin Ad Middle Post Content */
add_action('wp_ajax_wp_insert_inpostads_middle_form_get_content', 'wp_insert_inpostads_middle_form_get_content');
function wp_insert_inpostads_middle_form_get_content() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');
	wp_insert_inpostads_form_get_content('middle');
	die();
}

add_action('wp_ajax_wp_insert_inpostads_middle_form_save_action', 'wp_insert_inpostads_middle_form_save_action');
function wp_insert_inpostads_middle_form_save_action() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');	
	wp_insert_inpostads_form_save_action('middle');
	die();
}
/* End Ad Middle Post Content */

/* Begin Ad Below Post Content */
add_action('wp_ajax_wp_insert_inpostads_below_form_get_content', 'wp_insert_inpostads_below_form_get_content');
function wp_insert_inpostads_below_form_get_content() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');
	wp_insert_inpostads_form_get_content('below');
	die();
}

add_action('wp_ajax_wp_insert_inpostads_below_form_save_action', 'wp_insert_inpostads_below_form_save_action');
function wp_insert_inpostads_below_form_save_action() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');	
	wp_insert_inpostads_form_save_action('below');
	die();
}
/* End Ad Below Post Content */

/* Begin Ad Left Post Content */
add_action('wp_ajax_wp_insert_inpostads_left_form_get_content', 'wp_insert_inpostads_left_form_get_content');
function wp_insert_inpostads_left_form_get_content() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');
	wp_insert_inpostads_form_get_content('left');
	die();
}

add_action('wp_ajax_wp_insert_inpostads_left_form_save_action', 'wp_insert_inpostads_left_form_save_action');
function wp_insert_inpostads_left_form_save_action() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');	
	wp_insert_inpostads_form_save_action('left');
	die();
}
/* End Ad Left Post Content */

/* Begin Ad Right Post Content */
add_action('wp_ajax_wp_insert_inpostads_right_form_get_content', 'wp_insert_inpostads_right_form_get_content');
function wp_insert_inpostads_right_form_get_content() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');
	wp_insert_inpostads_form_get_content('right');
	die();
}

add_action('wp_ajax_wp_insert_inpostads_right_form_save_action', 'wp_insert_inpostads_right_form_save_action');
function wp_insert_inpostads_right_form_save_action() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');	
	wp_insert_inpostads_form_save_action('right');
	die();
}
/* End Ad Right Post Content */

/* Begin Shared UI Functions */
function wp_insert_inpostads_form_get_content($position) {
	$inpostads = get_option('wp_insert_inpostads');
	echo '<div class="wp_insert_popup_content_wrapper">';
		$posts_per_page = get_option('posts_per_page');
		$instances = array();
		for($i = 1; $i <= $posts_per_page; $i++) {
			$instances[] = array('text' => 'Hide on '.wp_insert_add_ordinal_number_suffix($i).' Post', 'value' => $i);
		}
		$control = new smartlogixControls(array('optionIdentifier' => 'wp_insert_inpostads['.$position.']', 'values' => $inpostads[$position]));
		$control->add_control(array('type' => 'ipCheckbox', 'optionName' => 'status'));
		echo '<div id="wp_insert_inpostads_'.$position.'_accordion">';
			echo '<h3>Ad Code</h3>';
			echo '<div>';
				$abtestingMode = get_option('wp_insert_abtesting_mode');
				$control->add_control(array('type' => 'textarea', 'style' => 'height: 220px;', 'optionName' => 'primary_ad_code'));
				$control->create_section('Ad Code (Primary Network)');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'textarea', 'style' => 'height: 220px;', 'optionName' => 'secondary_ad_code'));
				$control->create_section('Ad Code (Secondary Network)');
				if($abtestingMode != '2' && $abtestingMode != '3') {	
					$control->set_HTML('<div style="display: none;">'.$control->HTML.'</div>');
				}
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'textarea', 'style' => 'height: 220px;', 'optionName' => 'tertiary_ad_code'));
				$control->create_section('Ad Code (Tertiary Network)');
				if($abtestingMode != '3') {	
					$control->set_HTML('<div style="display: none;">'.$control->HTML.'</div>');
				}
				echo $control->HTML;
				$control->clear_controls();
			echo '</div>';
			echo '<h3>Rules</h3>';
			echo '<div>';
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_loggedin'));
				$control->create_section('Logged in Users');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_mobile_devices'));
				$control->create_section('Mobile Devices');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_home'));
				$control->add_control(array('type' => 'choosen-multiselect', 'label' => 'Instances', 'optionName' => 'rules_home_instances', 'options' => $instances));
				$control->create_section('Home');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_archives'));
				$control->add_control(array('type' => 'choosen-multiselect', 'label' => 'Instances', 'optionName' => 'rules_archives_instances', 'options' => $instances));
				$control->create_section('Archives');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_search'));
				$control->add_control(array('type' => 'choosen-multiselect', 'label' => 'Instances', 'optionName' => 'rules_search_instances', 'options' => $instances));
				$control->create_section('Search Results');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_page'));
				$control->add_control(array('type' => 'pages-chosen-multiselect', 'label' => 'Exceptions', 'optionName' => 'rules_page_exceptions'));
				$control->create_section('Single Pages');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_post'));
				$control->add_control(array('type' => 'posts-chosen-multiselect', 'label' => 'Exceptions', 'optionName' => 'rules_post_exceptions'));
				$control->add_control(array('type' => 'categories-chosen-multiselect', 'label' => 'Category Exceptions', 'optionName' => 'rules_post_categories_exceptions'));
				$control->create_section('Single Posts');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_categories'));
				$control->add_control(array('type' => 'choosen-multiselect', 'label' => 'Instances', 'optionName' => 'rules_categories_instances', 'options' => $instances));
				$control->add_control(array('type' => 'categories-chosen-multiselect', 'label' => 'Exceptions', 'optionName' => 'rules_categories_exceptions'));
				$control->create_section('Category Archives');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
				echo $control->HTML;
				$control->clear_controls();
				
			echo '</div>';
			echo '<h3>Geo Targeting</h3>';
			echo '<div>';
				echo '<p><b>This feature is temporarily unavailable as the servers we were using for FREE Geo Ip service has shut down.</b><br />(If you are interested in supporting us setup our own servers for continuing this service please contact the Author via support@smartlogix.co.in)</p>';
				echo '<p>A Geo Targeted Ads have a higher priority than Ads configured via Multiple Ad Networks / A-B Testing.<br />If a Geo Targeting match is found all other Ads (Primary, Secondary and Tertiary Networks) will be ignored.</p>';
				$control->add_control(array('type' => 'choosen-multiselect', 'label' => 'Countries', 'optionName' => 'geo_group1_countries', 'options' => wp_insert_get_countries()));
				$control->add_control(array('type' => 'textarea', 'label' => 'Ad Code', 'style' => 'height: 220px;', 'optionName' => 'geo_group1_adcode'));
				$control->create_section('Group 1');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'choosen-multiselect', 'label' => 'Countries', 'optionName' => 'geo_group2_countries', 'options' => wp_insert_get_countries()));
				$control->add_control(array('type' => 'textarea', 'label' => 'Ad Code', 'style' => 'height: 220px;', 'optionName' => 'geo_group2_adcode'));
				$control->create_section('Group 2');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
				echo $control->HTML;
				$control->clear_controls();
			echo '</div>';
			echo '<h3>Styles</h3>';
			echo '<div>';
				$control->add_control(array('type' => 'textarea', 'style' => 'height: 220px;', 'optionName' => 'styles'));
				$control->create_section('Styles');
				echo $control->HTML;
				$control->clear_controls();
			echo '</div>';
			echo '<h3>Notes</h3>';
			echo '<div>';
				$control->add_control(array('type' => 'textarea', 'style' => 'height: 220px;', 'optionName' => 'notes'));
				$control->create_section('Notes');
				echo $control->HTML;
				$control->clear_controls();
			echo '</div>';
			if($position == 'middle') {
				echo '<h3>Positioning</h3>';
				echo '<div>';
					$control->add_control(array('type' => 'text', 'label' => 'Minimum Character Count', 'optionName' => 'minimum_character_count', 'helpText' => 'Show the ad only if the Content meets the minimum character count. If this parameter is set to 0 (or empty) minimum character count check will be deactivated.'));
					$control->add_control(array('type' => 'text', 'label' => 'Paragraph Buffer Count', 'optionName' => 'paragraph_buffer_count', 'helpText' => 'Shows the ad after X number of Paragraphs. If this parameter is set to 0 (or empty) the ad will appear in the middle of the content.'));
					$control->create_section('Positioning');
					echo $control->HTML;
					$control->clear_controls();
				echo '</div>';
			}
		echo '</div>';
		echo '<script type="text/javascript">';
			echo $control->JS;
			echo 'jQuery("#wp_insert_inpostads_'.$position.'_accordion").accordion({ icons: { header: "ui-icon-circle-arrow-e", activeHeader: "ui-icon-circle-arrow-s" }, heightStyle: "auto" });';
		echo '</script>';
	echo '</div>';
}

function wp_insert_inpostads_form_save_action($position) {
	$inpostAds = get_option('wp_insert_inpostads');
	$inpostAds[$position]['status'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_status']) && ($_POST['wp_insert_inpostads_'.$position.'_status'] == 'true'))?'1':'');
	
	$inpostAds[$position]['primary_ad_code'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_primary_ad_code']))?$_POST['wp_insert_inpostads_'.$position.'_primary_ad_code']:'');
	$inpostAds[$position]['secondary_ad_code'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_secondary_ad_code']))?$_POST['wp_insert_inpostads_'.$position.'_secondary_ad_code']:'');
	$inpostAds[$position]['tertiary_ad_code'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_tertiary_ad_code']))?$_POST['wp_insert_inpostads_'.$position.'_tertiary_ad_code']:'');
	
	$inpostAds[$position]['rules_exclude_loggedin'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_exclude_loggedin']))?$_POST['wp_insert_inpostads_'.$position.'_rules_exclude_loggedin']:'');
	$inpostAds[$position]['rules_exclude_mobile_devices'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_exclude_mobile_devices']))?$_POST['wp_insert_inpostads_'.$position.'_rules_exclude_mobile_devices']:'');
	$inpostAds[$position]['rules_exclude_home'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_exclude_home']))?$_POST['wp_insert_inpostads_'.$position.'_rules_exclude_home']:'');
	$inpostAds[$position]['rules_home_instances'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_home_instances']))?$_POST['wp_insert_inpostads_'.$position.'_rules_home_instances']:'');
	$inpostAds[$position]['rules_exclude_archives'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_exclude_archives']))?$_POST['wp_insert_inpostads_'.$position.'_rules_exclude_archives']:'');
	$inpostAds[$position]['rules_archives_instances'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_archives_instances']))?$_POST['wp_insert_inpostads_'.$position.'_rules_archives_instances']:'');
	$inpostAds[$position]['rules_exclude_search'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_exclude_search']))?$_POST['wp_insert_inpostads_'.$position.'_rules_exclude_search']:'');
	$inpostAds[$position]['rules_search_instances'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_search_instances']))?$_POST['wp_insert_inpostads_'.$position.'_rules_search_instances']:'');
	$inpostAds[$position]['rules_exclude_page'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_exclude_page']))?$_POST['wp_insert_inpostads_'.$position.'_rules_exclude_page']:'');
	$inpostAds[$position]['rules_page_exceptions'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_page_exceptions']))?$_POST['wp_insert_inpostads_'.$position.'_rules_page_exceptions']:'');
	$inpostAds[$position]['rules_exclude_post'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_exclude_post']))?$_POST['wp_insert_inpostads_'.$position.'_rules_exclude_post']:'');
	$inpostAds[$position]['rules_post_exceptions'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_post_exceptions']))?$_POST['wp_insert_inpostads_'.$position.'_rules_post_exceptions']:'');
	$inpostAds[$position]['rules_post_categories_exceptions'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_post_categories_exceptions']))?$_POST['wp_insert_inpostads_'.$position.'_rules_post_categories_exceptions']:'');
	$inpostAds[$position]['rules_exclude_categories'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_exclude_categories']))?$_POST['wp_insert_inpostads_'.$position.'_rules_exclude_categories']:'');
	$inpostAds[$position]['rules_categories_instances'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_categories_instances']))?$_POST['wp_insert_inpostads_'.$position.'_rules_categories_instances']:'');
	$inpostAds[$position]['rules_categories_exceptions'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_rules_categories_exceptions']))?$_POST['wp_insert_inpostads_'.$position.'_rules_categories_exceptions']:'');
	
	$inpostAds[$position]['geo_group1_countries'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_geo_group1_countries']))?$_POST['wp_insert_inpostads_'.$position.'_geo_group1_countries']:'');
	$inpostAds[$position]['geo_group1_adcode'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_geo_group1_adcode']))?$_POST['wp_insert_inpostads_'.$position.'_geo_group1_adcode']:'');
	$inpostAds[$position]['geo_group2_countries'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_geo_group2_countries']))?$_POST['wp_insert_inpostads_'.$position.'_geo_group2_countries']:'');
	$inpostAds[$position]['geo_group2_adcode'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_geo_group2_adcode']))?$_POST['wp_insert_inpostads_'.$position.'_geo_group2_adcode']:'');
	
	$inpostAds[$position]['styles'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_styles']))?$_POST['wp_insert_inpostads_'.$position.'_styles']:'');
	
	$inpostAds[$position]['notes'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_notes']))?$_POST['wp_insert_inpostads_'.$position.'_notes']:'');
	
	if($position == 'middle') {
		$inpostAds[$position]['minimum_character_count'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_minimum_character_count']))?$_POST['wp_insert_inpostads_'.$position.'_minimum_character_count']:'');
		$inpostAds[$position]['paragraph_buffer_count'] = ((isset($_POST['wp_insert_inpostads_'.$position.'_paragraph_buffer_count']))?$_POST['wp_insert_inpostads_'.$position.'_paragraph_buffer_count']:'');
	}
	update_option('wp_insert_inpostads', $inpostAds);
}
/* End Shared UI Functions */

/* Begin Database Upgrade */
add_action('wp_insert_upgrade_database', 'wp_insert_inpostads_upgrade_database');
function wp_insert_inpostads_upgrade_database() {	
	if(!get_option('wp_insert_inpostads')) {
		$oldValues = get_option('wp_insert_inpostads_options');
		$newValues = array(
			'above' => array (
				'status' => ((isset($oldValues['above']['status']) && $oldValues['above']['status'] == true)?'1':''),
				'primary_ad_code' => ((isset($oldValues['above']['ad_code_1']))?$oldValues['above']['ad_code_1']:''),
				'secondary_ad_code' => ((isset($oldValues['above']['ad_code_2']))?$oldValues['above']['ad_code_2']:''),
				'tertiary_ad_code' => ((isset($oldValues['above']['ad_code_3']))?$oldValues['above']['ad_code_3']:''),
				'rules_exclude_loggedin' => ((isset($oldValues['above']['rules_exclude_loggedin']))?true:false),
				'rules_exclude_mobile_devices' => ((isset($oldValues['above']['rules_exclude_mobile_devices']))?true:false),
				'rules_exclude_home' => ((isset($oldValues['above']['rules_exclude_home']))?true:false),
				'rules_home_instances' => ((isset($options['above']['rules_home_instances']) && ($options['above']['rules_home_instances'] != ''))?explode(',', $options['above']['rules_home_instances']):array()),
				'rules_exclude_archives' => ((isset($oldValues['above']['rules_exclude_archives']))?true:false),
				'rules_archives_instances' => ((isset($options['above']['rules_archives_instances']) && ($options['above']['rules_archives_instances'] != ''))?explode(',', $options['above']['rules_archives_instances']):array()),
				'rules_exclude_search' => ((isset($oldValues['above']['rules_exclude_search']))?true:false),
				'rules_search_instances' => ((isset($options['above']['rules_search_instances']) && ($options['above']['rules_search_instances'] != ''))?explode(',', $options['above']['rules_search_instances']):array()),
				'rules_exclude_page' => ((isset($oldValues['above']['rules_exclude_page']))?true:false),
				'rules_page_exceptions' => ((isset($options['above']['rules_page_exceptions']) && ($options['above']['rules_page_exceptions'] != ''))?explode(',', $options['above']['rules_page_exceptions']):array()),
				'rules_exclude_post' => ((isset($oldValues['above']['rules_exclude_post']))?true:false),
				'rules_post_exceptions' => ((isset($options['above']['rules_post_exceptions']) && ($options['above']['rules_post_exceptions'] != ''))?explode(',', $options['above']['rules_post_exceptions']):array()),
				'rules_post_categories_exceptions' => ((isset($options['above']['rules_post_categories_exceptions']) && ($options['above']['rules_post_categories_exceptions'] != ''))?explode(',', $options['above']['rules_post_categories_exceptions']):array()),
				'rules_exclude_categories' => ((isset($oldValues['above']['rules_exclude_categories']))?true:false),
				'rules_categories_instances' => ((isset($options['above']['rules_categories_instances']) && ($options['above']['rules_categories_instances'] != ''))?explode(',', $options['above']['rules_categories_instances']):array()),
				'rules_categories_exceptions' => ((isset($options['above']['rules_categories_exceptions']) && ($options['above']['rules_categories_exceptions'] != ''))?explode(',', $options['above']['rules_categories_exceptions']):array()),
				'geo_group1_countries' => ((isset($options['above']['country_1']) && ($options['above']['country_1'] != ''))?explode(',', $options['above']['country_1']):array()),
				'geo_group1_adcode' => ((isset($oldValues['above']['country_code_1']))?$oldValues['above']['country_code_1']:''),
				'geo_group2_countries' => array(),
				'geo_group2_adcode' => '',
				'styles' => ((isset($oldValues['above']['styles']))?$oldValues['above']['styles']:'margin: 5px; padding: 0px;'),
				'notes' => ((isset($oldValues['above']['notes']))?$oldValues['above']['notes']:''),
			),
			'middle' => array (
				'status' => ((isset($oldValues['middle']['status']) && $oldValues['middle']['status'] == true)?'1':''),
				'primary_ad_code' => ((isset($oldValues['middle']['ad_code_1']))?$oldValues['middle']['ad_code_1']:''),
				'secondary_ad_code' => ((isset($oldValues['middle']['ad_code_2']))?$oldValues['middle']['ad_code_2']:''),
				'tertiary_ad_code' => ((isset($oldValues['middle']['ad_code_3']))?$oldValues['middle']['ad_code_3']:''),
				'rules_exclude_loggedin' => ((isset($oldValues['middle']['rules_exclude_loggedin']))?true:false),
				'rules_exclude_mobile_devices' => ((isset($oldValues['middle']['rules_exclude_mobile_devices']))?true:false),
				'rules_exclude_home' => ((isset($oldValues['middle']['rules_exclude_home']))?true:false),
				'rules_home_instances' => ((isset($options['middle']['rules_home_instances']) && ($options['middle']['rules_home_instances'] != ''))?explode(',', $options['middle']['rules_home_instances']):array()),
				'rules_exclude_archives' => ((isset($oldValues['middle']['rules_exclude_archives']))?true:false),
				'rules_archives_instances' => ((isset($options['middle']['rules_archives_instances']) && ($options['middle']['rules_archives_instances'] != ''))?explode(',', $options['middle']['rules_archives_instances']):array()),
				'rules_exclude_search' => ((isset($oldValues['middle']['rules_exclude_search']))?true:false),
				'rules_search_instances' => ((isset($options['middle']['rules_search_instances']) && ($options['middle']['rules_search_instances'] != ''))?explode(',', $options['middle']['rules_search_instances']):array()),
				'rules_exclude_page' => ((isset($oldValues['middle']['rules_exclude_page']))?true:false),
				'rules_page_exceptions' => ((isset($options['middle']['rules_page_exceptions']) && ($options['middle']['rules_page_exceptions'] != ''))?explode(',', $options['middle']['rules_page_exceptions']):array()),
				'rules_exclude_post' => ((isset($oldValues['middle']['rules_exclude_post']))?true:false),
				'rules_post_exceptions' => ((isset($options['middle']['rules_post_exceptions']) && ($options['middle']['rules_post_exceptions'] != ''))?explode(',', $options['middle']['rules_post_exceptions']):array()),
				'rules_post_categories_exceptions' => ((isset($options['middle']['rules_post_categories_exceptions']) && ($options['middle']['rules_post_categories_exceptions'] != ''))?explode(',', $options['middle']['rules_post_categories_exceptions']):array()),
				'rules_exclude_categories' => ((isset($oldValues['middle']['rules_exclude_categories']))?true:false),
				'rules_categories_instances' => ((isset($options['middle']['rules_categories_instances']) && ($options['middle']['rules_categories_instances'] != ''))?explode(',', $options['middle']['rules_categories_instances']):array()),
				'rules_categories_exceptions' => ((isset($options['middle']['rules_categories_exceptions']) && ($options['middle']['rules_categories_exceptions'] != ''))?explode(',', $options['middle']['rules_categories_exceptions']):array()),
				'geo_group1_countries' => ((isset($options['middle']['country_1']) && ($options['middle']['country_1'] != ''))?explode(',', $options['middle']['country_1']):array()),
				'geo_group1_adcode' => ((isset($oldValues['middle']['country_code_1']))?$oldValues['middle']['country_code_1']:''),
				'geo_group2_countries' => array(),
				'geo_group2_adcode' => '',
				'styles' => ((isset($oldValues['middle']['styles']))?$oldValues['middle']['styles']:'margin: 5px; padding: 0px;'),
				'notes' => ((isset($oldValues['middle']['notes']))?$oldValues['middle']['notes']:''),
				'minimum_character_count' => ((isset($oldValues['middle']['minimum_character_count']))?$oldValues['middle']['minimum_character_count']:'500'),
				'paragraph_buffer_count' => ((isset($oldValues['middle']['paragraph_buffer_count']))?$oldValues['middle']['paragraph_buffer_count']:''),
			),
			'below' => array (
				'status' => ((isset($oldValues['below']['status']) && $oldValues['below']['status'] == true)?'1':''),
				'primary_ad_code' => ((isset($oldValues['below']['ad_code_1']))?$oldValues['below']['ad_code_1']:''),
				'secondary_ad_code' => ((isset($oldValues['below']['ad_code_2']))?$oldValues['below']['ad_code_2']:''),
				'tertiary_ad_code' => ((isset($oldValues['below']['ad_code_3']))?$oldValues['below']['ad_code_3']:''),
				'rules_exclude_loggedin' => ((isset($oldValues['below']['rules_exclude_loggedin']))?true:false),
				'rules_exclude_mobile_devices' => ((isset($oldValues['below']['rules_exclude_mobile_devices']))?true:false),
				'rules_exclude_home' => ((isset($oldValues['below']['rules_exclude_home']))?true:false),
				'rules_home_instances' => ((isset($options['below']['rules_home_instances']) && ($options['below']['rules_home_instances'] != ''))?explode(',', $options['below']['rules_home_instances']):array()),
				'rules_exclude_archives' => ((isset($oldValues['below']['rules_exclude_archives']))?true:false),
				'rules_archives_instances' => ((isset($options['below']['rules_archives_instances']) && ($options['below']['rules_archives_instances'] != ''))?explode(',', $options['below']['rules_archives_instances']):array()),
				'rules_exclude_search' => ((isset($oldValues['below']['rules_exclude_search']))?true:false),
				'rules_search_instances' => ((isset($options['below']['rules_search_instances']) && ($options['below']['rules_search_instances'] != ''))?explode(',', $options['below']['rules_search_instances']):array()),
				'rules_exclude_page' => ((isset($oldValues['below']['rules_exclude_page']))?true:false),
				'rules_page_exceptions' => ((isset($options['below']['rules_page_exceptions']) && ($options['below']['rules_page_exceptions'] != ''))?explode(',', $options['below']['rules_page_exceptions']):array()),
				'rules_exclude_post' => ((isset($oldValues['below']['rules_exclude_post']))?true:false),
				'rules_post_exceptions' => ((isset($options['below']['rules_post_exceptions']) && ($options['below']['rules_post_exceptions'] != ''))?explode(',', $options['below']['rules_post_exceptions']):array()),
				'rules_post_categories_exceptions' => ((isset($options['below']['rules_post_categories_exceptions']) && ($options['below']['rules_post_categories_exceptions'] != ''))?explode(',', $options['below']['rules_post_categories_exceptions']):array()),
				'rules_exclude_categories' => ((isset($oldValues['below']['rules_exclude_categories']))?true:false),
				'rules_categories_instances' => ((isset($options['below']['rules_categories_instances']) && ($options['below']['rules_categories_instances'] != ''))?explode(',', $options['below']['rules_categories_instances']):array()),
				'rules_categories_exceptions' => ((isset($options['below']['rules_categories_exceptions']) && ($options['below']['rules_categories_exceptions'] != ''))?explode(',', $options['below']['rules_categories_exceptions']):array()),
				'geo_group1_countries' => ((isset($options['below']['country_1']) && ($options['below']['country_1'] != ''))?explode(',', $options['below']['country_1']):array()),
				'geo_group1_adcode' => ((isset($oldValues['below']['country_code_1']))?$oldValues['below']['country_code_1']:''),
				'geo_group2_countries' => array(),
				'geo_group2_adcode' => '',
				'styles' => ((isset($oldValues['below']['styles']))?$oldValues['below']['styles']:'margin: 5px; padding: 0px;'),
				'notes' => ((isset($oldValues['below']['notes']))?$oldValues['below']['notes']:''),
			),
			'left' => array (
				'status' => ((isset($oldValues['left']['status']) && $oldValues['left']['status'] == true)?'1':''),
				'primary_ad_code' => ((isset($oldValues['left']['ad_code_1']))?$oldValues['left']['ad_code_1']:''),
				'secondary_ad_code' => ((isset($oldValues['left']['ad_code_2']))?$oldValues['left']['ad_code_2']:''),
				'tertiary_ad_code' => ((isset($oldValues['left']['ad_code_3']))?$oldValues['left']['ad_code_3']:''),
				'rules_exclude_loggedin' => ((isset($oldValues['left']['rules_exclude_loggedin']))?true:false),
				'rules_exclude_mobile_devices' => ((isset($oldValues['left']['rules_exclude_mobile_devices']))?true:false),
				'rules_exclude_home' => ((isset($oldValues['left']['rules_exclude_home']))?true:false),
				'rules_home_instances' => ((isset($options['left']['rules_home_instances']) && ($options['left']['rules_home_instances'] != ''))?explode(',', $options['left']['rules_home_instances']):array()),
				'rules_exclude_archives' => ((isset($oldValues['left']['rules_exclude_archives']))?true:false),
				'rules_archives_instances' => ((isset($options['left']['rules_archives_instances']) && ($options['left']['rules_archives_instances'] != ''))?explode(',', $options['left']['rules_archives_instances']):array()),
				'rules_exclude_search' => ((isset($oldValues['left']['rules_exclude_search']))?true:false),
				'rules_search_instances' => ((isset($options['left']['rules_search_instances']) && ($options['left']['rules_search_instances'] != ''))?explode(',', $options['left']['rules_search_instances']):array()),
				'rules_exclude_page' => ((isset($oldValues['left']['rules_exclude_page']))?true:false),
				'rules_page_exceptions' => ((isset($options['left']['rules_page_exceptions']) && ($options['left']['rules_page_exceptions'] != ''))?explode(',', $options['left']['rules_page_exceptions']):array()),
				'rules_exclude_post' => ((isset($oldValues['left']['rules_exclude_post']))?true:false),
				'rules_post_exceptions' => ((isset($options['left']['rules_post_exceptions']) && ($options['left']['rules_post_exceptions'] != ''))?explode(',', $options['left']['rules_post_exceptions']):array()),
				'rules_post_categories_exceptions' => ((isset($options['left']['rules_post_categories_exceptions']) && ($options['left']['rules_post_categories_exceptions'] != ''))?explode(',', $options['left']['rules_post_categories_exceptions']):array()),
				'rules_exclude_categories' => ((isset($oldValues['left']['rules_exclude_categories']))?true:false),
				'rules_categories_instances' => ((isset($options['left']['rules_categories_instances']) && ($options['left']['rules_categories_instances'] != ''))?explode(',', $options['left']['rules_categories_instances']):array()),
				'rules_categories_exceptions' => ((isset($options['left']['rules_categories_exceptions']) && ($options['left']['rules_categories_exceptions'] != ''))?explode(',', $options['left']['rules_categories_exceptions']):array()),
				'geo_group1_countries' => ((isset($options['left']['country_1']) && ($options['left']['country_1'] != ''))?explode(',', $options['left']['country_1']):array()),
				'geo_group1_adcode' => ((isset($oldValues['left']['country_code_1']))?$oldValues['left']['country_code_1']:''),
				'geo_group2_countries' => array(),
				'geo_group2_adcode' => '',
				'styles' => ((isset($oldValues['left']['styles']))?$oldValues['left']['styles']:'margin: 5px; padding: 0px;'),
				'notes' => ((isset($oldValues['left']['notes']))?$oldValues['left']['notes']:''),
			),
			'right' => array (
				'status' => ((isset($oldValues['right']['status']) && $oldValues['right']['status'] == true)?'1':''),
				'primary_ad_code' => ((isset($oldValues['right']['ad_code_1']))?$oldValues['right']['ad_code_1']:''),
				'secondary_ad_code' => ((isset($oldValues['right']['ad_code_2']))?$oldValues['right']['ad_code_2']:''),
				'tertiary_ad_code' => ((isset($oldValues['right']['ad_code_3']))?$oldValues['right']['ad_code_3']:''),
				'rules_exclude_loggedin' => ((isset($oldValues['right']['rules_exclude_loggedin']))?true:false),
				'rules_exclude_mobile_devices' => ((isset($oldValues['right']['rules_exclude_mobile_devices']))?true:false),
				'rules_exclude_home' => ((isset($oldValues['right']['rules_exclude_home']))?true:false),
				'rules_home_instances' => ((isset($options['right']['rules_home_instances']) && ($options['right']['rules_home_instances'] != ''))?explode(',', $options['right']['rules_home_instances']):array()),
				'rules_exclude_archives' => ((isset($oldValues['right']['rules_exclude_archives']))?true:false),
				'rules_archives_instances' => ((isset($options['right']['rules_archives_instances']) && ($options['right']['rules_archives_instances'] != ''))?explode(',', $options['right']['rules_archives_instances']):array()),
				'rules_exclude_search' => ((isset($oldValues['right']['rules_exclude_search']))?true:false),
				'rules_search_instances' => ((isset($options['right']['rules_search_instances']) && ($options['right']['rules_search_instances'] != ''))?explode(',', $options['right']['rules_search_instances']):array()),
				'rules_exclude_page' => ((isset($oldValues['right']['rules_exclude_page']))?true:false),
				'rules_page_exceptions' => ((isset($options['right']['rules_page_exceptions']) && ($options['right']['rules_page_exceptions'] != ''))?explode(',', $options['right']['rules_page_exceptions']):array()),
				'rules_exclude_post' => ((isset($oldValues['right']['rules_exclude_post']))?true:false),
				'rules_post_exceptions' => ((isset($options['right']['rules_post_exceptions']) && ($options['right']['rules_post_exceptions'] != ''))?explode(',', $options['right']['rules_post_exceptions']):array()),
				'rules_post_categories_exceptions' => ((isset($options['right']['rules_post_categories_exceptions']) && ($options['right']['rules_post_categories_exceptions'] != ''))?explode(',', $options['right']['rules_post_categories_exceptions']):array()),
				'rules_exclude_categories' => ((isset($oldValues['right']['rules_exclude_categories']))?true:false),
				'rules_categories_instances' => ((isset($options['right']['rules_categories_instances']) && ($options['right']['rules_categories_instances'] != ''))?explode(',', $options['right']['rules_categories_instances']):array()),
				'rules_categories_exceptions' => ((isset($options['right']['rules_categories_exceptions']) && ($options['right']['rules_categories_exceptions'] != ''))?explode(',', $options['right']['rules_categories_exceptions']):array()),
				'geo_group1_countries' => ((isset($options['right']['country_1']) && ($options['right']['country_1'] != ''))?explode(',', $options['right']['country_1']):array()),
				'geo_group1_adcode' => ((isset($oldValues['right']['country_code_1']))?$oldValues['right']['country_code_1']:''),
				'geo_group2_countries' => array(),
				'geo_group2_adcode' => '',
				'styles' => ((isset($oldValues['right']['styles']))?$oldValues['right']['styles']:'margin: 5px; padding: 0px;'),
				'notes' => ((isset($oldValues['right']['notes']))?$oldValues['right']['notes']:''),
			)
		);
		update_option('wp_insert_inpostads', $newValues);
	}
}
/* End Database Upgrade */

/* Begin Ad Insertion */
add_filter('the_content', 'wp_insert_inpostads_the_content', 100);
function wp_insert_inpostads_the_content($content) {
	if(!is_feed() && is_main_query()) {
		$inpostAds = get_option('wp_insert_inpostads');

		if(wp_insert_get_ad_status($inpostAds['middle'])) {
			$paragraphCount = wp_insert_inpostads_get_paragraph_count($content);
			if($paragraphCount > 1) {
				if(($inpostAds['middle']['paragraph_buffer_count'] == 0) || ($inpostAds['middle']['paragraph_buffer_count'] == '')) {
					$position = wp_insert_inpostads_get_midpoint('/p>', $content, round($paragraphCount / 2));
				} else {			
					$position = wp_insert_inpostads_get_midpoint('/p>', $content, $inpostAds['middle']['paragraph_buffer_count']);
				}
				if($position) {
					if(($inpostAds['middle']['minimum_character_count'] == 0) || ($inpostAds['middle']['minimum_character_count'] == '')) {
						$content = substr_replace($content, '/p>'.'<div class="wpInsert wpInsertInPostAd wpInsertMiddle"'.(($inpostAds['middle']['styles'] != '')?' style="'.$inpostAds['middle']['styles'].'"':'').'>'.wp_insert_get_geotargeted_adcode($inpostAds['middle']).'</div>', $position, 3);
					} else {
						if(strlen(strip_tags($content)) > $inpostAds['middle']['minimum_character_count']) {
							$content = substr_replace($content, '/p>'.'<div class="wpInsert wpInsertInPostAd wpInsertMiddle"'.(($inpostAds['middle']['styles'] != '')?' style="'.$inpostAds['middle']['styles'].'"':'').'>'.wp_insert_get_geotargeted_adcode($inpostAds['middle']).'</div>', $position, 3);
						}
					}
				}
			}
		}
		if(wp_insert_get_ad_status($inpostAds['left'])) {
			$content = '<div class="wpInsert wpInsertInPostAd wpInsertLeft" style="float: left; '.(($inpostAds['left']['styles'] != '')?$inpostAds['left']['styles']:'').'">'.wp_insert_get_geotargeted_adcode($inpostAds['left']).'</div>'.$content;
		}
		if(wp_insert_get_ad_status($inpostAds['right'])) {
			$content = '<div class="wpInsert wpInsertInPostAd wpInsertRight" style="float: right; '.(($inpostAds['right']['styles'] != '')?$inpostAds['right']['styles']:'').'">'.wp_insert_get_geotargeted_adcode($inpostAds['right']).'</div>'.$content;
		}
		if(wp_insert_get_ad_status($inpostAds['above'])) {
			$content = '<div class="wpInsert wpInsertInPostAd wpInsertAbove"'.(($inpostAds['above']['styles'] != '')?' style="'.$inpostAds['above']['styles'].'"':'').'>'.wp_insert_get_geotargeted_adcode($inpostAds['above']).'</div>'.$content;
		}
		if(wp_insert_get_ad_status($inpostAds['below'])) {
			$content = $content.'<div class="wpInsert wpInsertInPostAd wpInsertBelow"'.(($inpostAds['below']['styles'] != '')?' style="'.$inpostAds['below']['styles'].'"':'').'>'.wp_insert_get_geotargeted_adcode($inpostAds['below']).'</div>';
		}
	}
	return $content;
}

function wp_insert_inpostads_get_paragraph_count($content) {
	$paragraphs = explode('/p>', $content);
	$paragraphCount = 0;
	if(is_array($paragraphs)) {
		foreach($paragraphs as $paragraph) {
			if(strlen($paragraph) > 1) {
				$paragraphCount++;
			}
		}
	}
	return $paragraphCount;
}

function wp_insert_inpostads_get_midpoint($search, $string, $offset) {
    $arr = explode($search, $string);
    switch($offset) {
        case $offset == 0:
			return false;
			break;
        case $offset > max(array_keys($arr)):
			return false;
			break;
        default:
			return strlen(implode($search, array_slice($arr, 0, $offset)));
			break;
    }
}
/* End Ad Insertion */
?>