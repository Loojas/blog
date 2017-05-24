jQuery(document).ready(function() {
	wp_insert_click_handler(
		'wp_insert_abtesting_configuration',
		'Multiple Ad Networks / A-B Testing : Configuration',
		'480',
		'480',
		function() { },
		function() {
			jQuery.post(
				jQuery('#wp_insert_admin_ajax').val(), {
					'action': "wp_insert_abtesting_configuration_form_save_action",
					'wp_insert_nonce': jQuery('#wp_insert_nonce').val(),
					'wp_insert_abtesting_mode': jQuery('input[name=wp_insert_abtesting_mode]:checked').val()
				}, function(response) { }			
			);
		},
		function() { }
	);
	
	wp_insert_click_handler(
		'wp_insert_trackingcodes_google_analytics',
		'Tracking Codes : Google Analytics',
		'480',
		'480',
		function() {
			jQuery('#wp_insert_trackingcodes_analytics_status').parent().css({'display': 'inline-block', 'margin': '5px 0 0'}).prependTo('.ui-dialog-buttonpane');
		},
		function() {
			jQuery.post(
				jQuery('#wp_insert_admin_ajax').val(), {
					'action': 'wp_insert_trackingcodes_google_analytics_form_save_action',
					'wp_insert_nonce': jQuery('#wp_insert_nonce').val(),
					'wp_insert_trackingcodes_analytics_status': jQuery('#wp_insert_trackingcodes_analytics_status').prop('checked'),
					'wp_insert_trackingcodes_analytics_code': jQuery('#wp_insert_trackingcodes_analytics_code').val(),
				}, function(response) { }
			);
		},
		function() { }
	);
	
	wp_insert_click_handler(
		'wp_insert_trackingcodes_header',
		'Tracking Codes : Header',
		jQuery("body").width() * 0.8,
		jQuery("body").height() * 0.8,
		function() {
			jQuery('#wp_insert_trackingcodes_header_code').css('height', (jQuery("body").height() * 0.5)+'px');
			jQuery('#wp_insert_trackingcodes_header_status').parent().css({'display': 'inline-block', 'margin': '5px 0 0'}).prependTo('.ui-dialog-buttonpane');
		},
		function() {
			jQuery.post(
				jQuery('#wp_insert_admin_ajax').val(), {
					'action': 'wp_insert_trackingcodes_header_form_save_action',
					'wp_insert_nonce': jQuery('#wp_insert_nonce').val(),
					'wp_insert_trackingcodes_header_status': jQuery('#wp_insert_trackingcodes_header_status').prop('checked'),
					'wp_insert_trackingcodes_header_code': jQuery('#wp_insert_trackingcodes_header_code').val(),
				}, function(response) { }
			);
		},
		function() { }
	);
	
	wp_insert_click_handler(
		'wp_insert_trackingcodes_footer',
		'Tracking Codes : Footer',
		jQuery("body").width() * 0.8,
		jQuery("body").height() * 0.8,
		function() {
			jQuery('#wp_insert_trackingcodes_footer_code').css('height', (jQuery("body").height() * 0.5)+'px');
			jQuery('#wp_insert_trackingcodes_footer_status').parent().css({'display': 'inline-block', 'margin': '5px 0 0'}).prependTo('.ui-dialog-buttonpane');
		},
		function() {
			jQuery.post(
				jQuery('#wp_insert_admin_ajax').val(), {
					'action': 'wp_insert_trackingcodes_footer_form_save_action',
					'wp_insert_nonce': jQuery('#wp_insert_nonce').val(),
					'wp_insert_trackingcodes_footer_status': jQuery('#wp_insert_trackingcodes_footer_status').prop('checked'),
					'wp_insert_trackingcodes_footer_code': jQuery('#wp_insert_trackingcodes_footer_code').val(),
				}, function(response) { }
			);
		},
		function() { }
	);
	
	wp_insert_click_handler(
		'wp_insert_legalpages_privacy_policy',
		'Legal Pages : Privacy Policy',
		jQuery("body").width() * 0.8,
		jQuery("body").height() * 0.8,
		function() { },
		function() {
			tinyMCE.triggerSave();
			jQuery.post(
				jQuery('#wp_insert_admin_ajax').val(), {
					'action': 'wp_insert_legalpages_privacy_policy_form_save_action',
					'wp_insert_nonce': jQuery('#wp_insert_nonce').val(),
					'wp_insert_legalpages_privacy_policy_content': jQuery('#wp_insert_legalpages_privacy_policy_content').val(),
					'wp_insert_legalpages_privacy_policy_assigned_page': jQuery('#wp_insert_legalpages_privacy_policy_assigned_page').val(),
				}, function(response) { }
			);
		},
		function() { }
	);
	
	wp_insert_click_handler(
		'wp_insert_legalpages_terms_conditions',
		'Legal Pages : Terms and Conditions',
		jQuery("body").width() * 0.8,
		jQuery("body").height() * 0.8,
		function() { },
		function() {
			tinyMCE.triggerSave();
			jQuery.post(
				jQuery('#wp_insert_admin_ajax').val(), {
					'action': 'wp_insert_legalpages_terms_conditions_form_save_action',
					'wp_insert_nonce': jQuery('#wp_insert_nonce').val(),
					'wp_insert_legalpages_terms_conditions_content': jQuery('#wp_insert_legalpages_terms_conditions_content').val(),
					'wp_insert_legalpages_terms_conditions_assigned_page': jQuery('#wp_insert_legalpages_terms_conditions_assigned_page').val(),
				}, function(response) { }
			);
		},
		function() { }
	);
	
	wp_insert_click_handler(
		'wp_insert_legalpages_disclaimer',
		'Legal Pages : Disclaimer',
		jQuery("body").width() * 0.8,
		jQuery("body").height() * 0.8,
		function() { },
		function() {
			tinyMCE.triggerSave();
			jQuery.post(
				jQuery('#wp_insert_admin_ajax').val(), {
					'action': 'wp_insert_legalpages_disclaimer_form_save_action',
					'wp_insert_nonce': jQuery('#wp_insert_nonce').val(),
					'wp_insert_legalpages_disclaimer_content': jQuery('#wp_insert_legalpages_disclaimer_content').val(),
					'wp_insert_legalpages_disclaimer_assigned_page': jQuery('#wp_insert_legalpages_disclaimer_assigned_page').val(),
				}, function(response) { }
			);
		},
		function() { }
	);
	
	wp_insert_click_handler(
		'wp_insert_legalpages_copyright',
		'Legal Pages : Copyright Notice',
		jQuery("body").width() * 0.8,
		jQuery("body").height() * 0.8,
		function() { },
		function() {
			tinyMCE.triggerSave();
			jQuery.post(
				jQuery('#wp_insert_admin_ajax').val(), {
					'action': 'wp_insert_legalpages_copyright_form_save_action',
					'wp_insert_nonce': jQuery('#wp_insert_nonce').val(),
					'wp_insert_legalpages_copyright_content': jQuery('#wp_insert_legalpages_copyright_content').val(),
					'wp_insert_legalpages_copyright_assigned_page': jQuery('#wp_insert_legalpages_copyright_assigned_page').val(),
				}, function(response) { }
			);
		},
		function() { }
	);
	
	wp_insert_inpostads_click_handler('above');
	wp_insert_inpostads_click_handler('middle');
	wp_insert_inpostads_click_handler('below');
	wp_insert_inpostads_click_handler('left');
	wp_insert_inpostads_click_handler('right');
	
	wp_insert_click_handler(
		'wp_insert_adwidgets_new',
		'Ad Widget : Add New',
		jQuery("body").width() * 0.8,
		jQuery("body").height() * 0.8,
		function() {
			jQuery('.wp_insert_adwidgets_status').parent().css({'display': 'inline-block', 'margin': '5px 0 0'}).prependTo('.ui-dialog-buttonpane');
		},
		function() {
			var identifier = jQuery(".wp_insert_adwidgets_identifier").val();
			var adwidgetLink = jQuery("<a></a>");
			adwidgetLink.attr("id", "wp_insert_adwidgets_"+identifier);
			adwidgetLink.attr("href", "javascript:;");
			adwidgetLink.attr("onClick", "wp_insert_adwidgets_click_handler(\'"+identifier+"\', \'"+jQuery("#wp_insert_adwidgets_"+identifier+"_title").val()+"\')");
			adwidgetLink.html("Ad Widget : "+jQuery("#wp_insert_adwidgets_"+identifier+"_title").val());
			var deleteButton = jQuery("<span></span>");
			deleteButton.attr("class", "dashicons dashicons-dismiss wp_insert_delete_icon");
			deleteButton.attr("onClick", "wp_insert_adwidgets_remove(\'"+identifier+"\')");
			jQuery("#wp_insert_adwidgets_new").parent().before(jQuery("<p></p>").append(adwidgetLink, deleteButton));
			wp_insert_adwidgets_update(identifier);
		},
		function() { }
	);
	
	wp_insert_click_handler(
		'wp_insert_inthemeads_new',
		'In-Theme Ad : Add New',
		jQuery("body").width() * 0.8,
		jQuery("body").height() * 0.8,
		function() {
			jQuery('.wp_insert_inthemeads_status').parent().css({'display': 'inline-block', 'margin': '5px 0 0'}).prependTo('.ui-dialog-buttonpane');
		},
		function() {
			var identifier = jQuery(".wp_insert_inthemeads_identifier").val();
			var inthemeadLink = jQuery("<a></a>");
			inthemeadLink.attr("id", "wp_insert_inthemeads_"+identifier);
			inthemeadLink.attr("href", "javascript:;");
			inthemeadLink.attr("onClick", "wp_insert_inthemeads_click_handler(\'"+identifier+"\', \'"+jQuery("#wp_insert_inthemeads_"+identifier+"_title").val()+"\')");
			inthemeadLink.html("Ad Widget : "+jQuery("#wp_insert_inthemeads_"+identifier+"_title").val());
			var deleteButton = jQuery("<span></span>");
			deleteButton.attr("class", "dashicons dashicons-dismiss wp_insert_delete_icon");
			deleteButton.attr("onClick", "wp_insert_inthemeads_remove(\'"+identifier+"\')");
			jQuery("#wp_insert_inthemeads_new").parent().before(jQuery("<p></p>").append(inthemeadLink, deleteButton));
			wp_insert_inthemeads_update(identifier);
		},
		function() { }
	);
});


function wp_insert_inpostads_click_handler(location) {
	wp_insert_click_handler(
		'wp_insert_inpostads_'+location,
		'Inpost Ads : Ad '+location.charAt(0).toUpperCase()+location.slice(1)+' Post Content',
		jQuery("body").width() * 0.8,
		jQuery("body").height() * 0.9,
		function() {
			jQuery('#wp_insert_inpostads_'+location+'_status').parent().css({'display': 'inline-block', 'margin': '5px 0 0'}).prependTo('.ui-dialog-buttonpane');
		},
		function() {
			args = {};
			args['action'] = 'wp_insert_inpostads_'+location+'_form_save_action';
			args['wp_insert_nonce'] = jQuery('#wp_insert_nonce').val();
			args['wp_insert_inpostads_'+location+'_status'] = jQuery('#wp_insert_inpostads_'+location+'_status').prop('checked');
			
			args['wp_insert_inpostads_'+location+'_primary_ad_code'] = jQuery('#wp_insert_inpostads_'+location+'_primary_ad_code').val();
			args['wp_insert_inpostads_'+location+'_secondary_ad_code'] = jQuery('#wp_insert_inpostads_'+location+'_secondary_ad_code').val();
			args['wp_insert_inpostads_'+location+'_tertiary_ad_code'] = jQuery('#wp_insert_inpostads_'+location+'_tertiary_ad_code').val();
			
			args['wp_insert_inpostads_'+location+'_rules_exclude_loggedin'] = jQuery('#wp_insert_inpostads_'+location+'_rules_exclude_loggedin').prop('checked');
			args['wp_insert_inpostads_'+location+'_rules_exclude_mobile_devices'] = jQuery('#wp_insert_inpostads_'+location+'_rules_exclude_mobile_devices').prop('checked');
			args['wp_insert_inpostads_'+location+'_rules_exclude_home'] = jQuery('#wp_insert_inpostads_'+location+'_rules_exclude_home').prop('checked');
			args['wp_insert_inpostads_'+location+'_rules_home_instances'] = jQuery.map(jQuery('#wp_insert_inpostads_'+location+'_rules_home_instances :selected'), function(e) { return jQuery(e).val(); });
			args['wp_insert_inpostads_'+location+'_rules_exclude_archives'] = jQuery('#wp_insert_inpostads_'+location+'_rules_exclude_archives').prop('checked');
			args['wp_insert_inpostads_'+location+'_rules_archives_instances'] = jQuery.map(jQuery('#wp_insert_inpostads_'+location+'_rules_archives_instances :selected'), function(e) { return jQuery(e).val(); });
			args['wp_insert_inpostads_'+location+'_rules_exclude_search'] = jQuery('#wp_insert_inpostads_'+location+'_rules_exclude_search').prop('checked');
			args['wp_insert_inpostads_'+location+'_rules_search_instances'] = jQuery.map(jQuery('#wp_insert_inpostads_'+location+'_rules_search_instances :selected'), function(e) { return jQuery(e).val(); });
			args['wp_insert_inpostads_'+location+'_rules_exclude_page'] = jQuery('#wp_insert_inpostads_'+location+'_rules_exclude_page').prop('checked');
			args['wp_insert_inpostads_'+location+'_rules_page_exceptions'] = jQuery.map(jQuery('#wp_insert_inpostads_'+location+'_rules_page_exceptions :selected'), function(e) { return jQuery(e).val(); });
			args['wp_insert_inpostads_'+location+'_rules_exclude_post'] = jQuery('#wp_insert_inpostads_'+location+'_rules_exclude_post').prop('checked');
			args['wp_insert_inpostads_'+location+'_rules_post_exceptions'] = jQuery.map(jQuery('#wp_insert_inpostads_'+location+'_rules_post_exceptions :selected'), function(e) { return jQuery(e).val(); });
			args['wp_insert_inpostads_'+location+'_rules_post_categories_exceptions'] = jQuery.map(jQuery('#wp_insert_inpostads_'+location+'_rules_post_categories_exceptions :selected'), function(e) { return jQuery(e).val(); });
			args['wp_insert_inpostads_'+location+'_rules_exclude_categories'] = jQuery('#wp_insert_inpostads_'+location+'_rules_exclude_categories').prop('checked');
			args['wp_insert_inpostads_'+location+'_rules_categories_instances'] = jQuery.map(jQuery('#wp_insert_inpostads_'+location+'_rules_categories_instances :selected'), function(e) { return jQuery(e).val(); });
			args['wp_insert_inpostads_'+location+'_rules_categories_exceptions'] = jQuery.map(jQuery('#wp_insert_inpostads_'+location+'_rules_categories_exceptions :selected'), function(e) { return jQuery(e).val(); });
			
			args['wp_insert_inpostads_'+location+'_geo_group1_countries'] = jQuery.map(jQuery('#wp_insert_inpostads_'+location+'_geo_group1_countries :selected'), function(e) { return jQuery(e).val(); });
			args['wp_insert_inpostads_'+location+'_geo_group1_adcode'] = jQuery('#wp_insert_inpostads_'+location+'_geo_group1_adcode').val();
			args['wp_insert_inpostads_'+location+'_geo_group2_countries'] = jQuery.map(jQuery('#wp_insert_inpostads_'+location+'_geo_group2_countries :selected'), function(e) { return jQuery(e).val(); });
			args['wp_insert_inpostads_'+location+'_geo_group2_adcode'] = jQuery('#wp_insert_inpostads_'+location+'_geo_group2_adcode').val();
			
			args['wp_insert_inpostads_'+location+'_styles'] = jQuery('#wp_insert_inpostads_'+location+'_styles').val();
			
			args['wp_insert_inpostads_'+location+'_notes'] = jQuery('#wp_insert_inpostads_'+location+'_notes').val();
			
			if(location == 'middle') {
				args['wp_insert_inpostads_'+location+'_minimum_character_count'] = jQuery('#wp_insert_inpostads_'+location+'_minimum_character_count').val();
				args['wp_insert_inpostads_'+location+'_paragraph_buffer_count'] = jQuery('#wp_insert_inpostads_'+location+'_paragraph_buffer_count').val();
			}
			jQuery.post(
				jQuery('#wp_insert_admin_ajax').val(), args, function(response) { }
			);
		},
		function() { }
	);
}

function wp_insert_adwidgets_click_handler(identifier, title) {
	jQuery('<div id="wp_insert_adwidgets_'+identifier+'_dialog"></div>').html('<div class="wp_insert_ajaxloader"></div>').dialog({
		'modal': true,
		'resizable': false,
		'width': jQuery("body").width() * 0.8,
		'maxWidth': jQuery("body").width() * 0.8,
		'maxHeight': jQuery("body").height() * 0.9,
		'title': 'Ad Widget : '+title,
		position: { my: 'center', at: 'center', of: window },
		open: function (event, ui) {
			jQuery('.ui-dialog').css({'z-index': 999999, 'max-width': '90%'});
			jQuery('.ui-widget-overlay').css({'z-index': 999998, 'opacity': 0.8, 'background': '#000000'});
			jQuery('.ui-dialog-buttonpane button:contains("Update")').button('disable');			
			jQuery.post(
				jQuery('#wp_insert_admin_ajax').val(), {
					'action': 'wp_insert_adwidgets_existing_form_get_content',
					'wp_insert_adwidgets_identifier': identifier,
					'wp_insert_nonce': jQuery('#wp_insert_nonce').val()
				}, function(response) {
					jQuery('.wp_insert_ajaxloader').hide();
					jQuery('.ui-dialog-content').html(response);
					jQuery('.ui-accordion .ui-accordion-content').css('max-height', (jQuery("body").height() * 0.45));
					jQuery('.ui-dialog-buttonpane button:contains("Update")').button('enable');
					jQuery('.wp_insert_adwidgets_status').parent().css({'display': 'inline-block', 'margin': '5px 0 0'}).prependTo('.ui-dialog-buttonpane');
					jQuery('.ui-dialog').css({'position': 'fixed'});
					jQuery('#wp_insert_adwidgets_'+identifier+'_dialog').delay(500).dialog({position: { my: 'center', at: 'center', of: window }});
				}			
			);
		},
		buttons: {
			'Update': function() {
				jQuery("#wp_insert_adwidgets_"+identifier).html("Ad Widget : "+jQuery("#wp_insert_adwidgets_"+identifier+"_title").val());
				jQuery("#wp_insert_adwidgets_"+identifier).attr("onClick", "wp_insert_adwidgets_click_handler(\'"+identifier+"\', \'"+jQuery("#wp_insert_adwidgets_"+identifier+"_title").val()+"\')");
				wp_insert_adwidgets_update(identifier);
				jQuery(this).dialog('close');
			},
			Cancel: function() {
				jQuery(this).dialog('close');
			}
		},
		close: function() {
			jQuery(this).dialog('destroy');
		}
	});
}

function wp_insert_adwidgets_update(identifier) {
	args = {};
	args['action'] = 'wp_insert_adwidgets_existing_form_save_action';
	args['wp_insert_nonce'] = jQuery('#wp_insert_nonce').val();
	args['wp_insert_adwidgets_identifier'] = identifier;
	args['wp_insert_adwidgets_'+identifier+'_status'] = jQuery('#wp_insert_adwidgets_'+identifier+'_status').prop('checked');
	
	args['wp_insert_adwidgets_'+identifier+'_title'] = jQuery('#wp_insert_adwidgets_'+identifier+'_title').val();
	
	args['wp_insert_adwidgets_'+identifier+'_primary_ad_code'] = jQuery('#wp_insert_adwidgets_'+identifier+'_primary_ad_code').val();
	args['wp_insert_adwidgets_'+identifier+'_secondary_ad_code'] = jQuery('#wp_insert_adwidgets_'+identifier+'_secondary_ad_code').val();
	args['wp_insert_adwidgets_'+identifier+'_tertiary_ad_code'] = jQuery('#wp_insert_adwidgets_'+identifier+'_tertiary_ad_code').val();
	
	args['wp_insert_adwidgets_'+identifier+'_rules_exclude_loggedin'] = jQuery('#wp_insert_adwidgets_'+identifier+'_rules_exclude_loggedin').prop('checked');
	args['wp_insert_adwidgets_'+identifier+'_rules_exclude_mobile_devices'] = jQuery('#wp_insert_adwidgets_'+identifier+'_rules_exclude_mobile_devices').prop('checked');
	args['wp_insert_adwidgets_'+identifier+'_rules_exclude_home'] = jQuery('#wp_insert_adwidgets_'+identifier+'_rules_exclude_home').prop('checked');
	args['wp_insert_adwidgets_'+identifier+'_rules_exclude_archives'] = jQuery('#wp_insert_adwidgets_'+identifier+'_rules_exclude_archives').prop('checked');
	args['wp_insert_adwidgets_'+identifier+'_rules_exclude_search'] = jQuery('#wp_insert_adwidgets_'+identifier+'_rules_exclude_search').prop('checked');
	args['wp_insert_adwidgets_'+identifier+'_rules_exclude_page'] = jQuery('#wp_insert_adwidgets_'+identifier+'_rules_exclude_page').prop('checked');
	args['wp_insert_adwidgets_'+identifier+'_rules_page_exceptions'] = jQuery.map(jQuery('#wp_insert_adwidgets_'+identifier+'_rules_page_exceptions :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_adwidgets_'+identifier+'_rules_exclude_post'] = jQuery('#wp_insert_adwidgets_'+identifier+'_rules_exclude_post').prop('checked');
	args['wp_insert_adwidgets_'+identifier+'_rules_post_exceptions'] = jQuery.map(jQuery('#wp_insert_adwidgets_'+identifier+'_rules_post_exceptions :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_adwidgets_'+identifier+'_rules_post_categories_exceptions'] = jQuery.map(jQuery('#wp_insert_adwidgets_'+identifier+'_rules_post_categories_exceptions :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_adwidgets_'+identifier+'_rules_exclude_categories'] = jQuery('#wp_insert_adwidgets_'+identifier+'_rules_exclude_categories').prop('checked');
	args['wp_insert_adwidgets_'+identifier+'_rules_categories_exceptions'] = jQuery.map(jQuery('#wp_insert_adwidgets_'+identifier+'_rules_categories_exceptions :selected'), function(e) { return jQuery(e).val(); });
	
	args['wp_insert_adwidgets_'+identifier+'_geo_group1_countries'] = jQuery.map(jQuery('#wp_insert_adwidgets_'+identifier+'_geo_group1_countries :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_adwidgets_'+identifier+'_geo_group1_adcode'] = jQuery('#wp_insert_adwidgets_'+identifier+'_geo_group1_adcode').val();
	args['wp_insert_adwidgets_'+identifier+'_geo_group2_countries'] = jQuery.map(jQuery('#wp_insert_adwidgets_'+identifier+'_geo_group2_countries :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_adwidgets_'+identifier+'_geo_group2_adcode'] = jQuery('#wp_insert_adwidgets_'+identifier+'_geo_group2_adcode').val();
	
	args['wp_insert_adwidgets_'+identifier+'_styles'] = jQuery('#wp_insert_adwidgets_'+identifier+'_styles').val();
	
	args['wp_insert_adwidgets_'+identifier+'_notes'] = jQuery('#wp_insert_adwidgets_'+identifier+'_notes').val();
	
	jQuery.post(
		jQuery('#wp_insert_admin_ajax').val(), args, function(response) { }
	);
}

function wp_insert_adwidgets_remove(identifier) {
	jQuery("<p>Are you Sure you want to remove this Ad Unit?</p>").dialog({
		'modal': true,
		'resizable': false,
		'title': 'Deletion Confirmation',
		position: { my: 'center', at: 'center', of: window },
		open: function (event, ui) {
			jQuery('.ui-dialog').css({'z-index': 999999, 'max-width': '90%'});
			jQuery('.ui-widget-overlay').css({'z-index': 999998, 'opacity': 0.8, 'background': '#000000'});
		},
		buttons : {
			'Confirm': function() {
				jQuery("#wp_insert_adwidgets_"+identifier).parent().remove();
				jQuery.post(
					jQuery('#wp_insert_admin_ajax').val(), {
						'action': 'wp_insert_adwidgets_remove',
						'wp_insert_adwidgets_identifier': identifier,
						'wp_insert_nonce': jQuery('#wp_insert_nonce').val()
					}, function(response) {
					}			
				);
				jQuery(this).dialog("close");
			},
			'Cancel': function() {
				jQuery(this).dialog("close");
			}
		},
		close: function() {
			jQuery(this).dialog('destroy');
		}
	});
}

function wp_insert_inthemeads_click_handler(identifier, title) {
	jQuery('<div id="wp_insert_inthemeads_'+identifier+'_dialog"></div>').html('<div class="wp_insert_ajaxloader"></div>').dialog({
		'modal': true,
		'resizable': false,
		'width': jQuery("body").width() * 0.8,
		'maxWidth': jQuery("body").width() * 0.8,
		'maxHeight': jQuery("body").height() * 0.9,
		'title': 'In-Theme Ad : '+title,
		position: { my: 'center', at: 'center', of: window },
		open: function (event, ui) {
			jQuery('.ui-dialog').css({'z-index': 999999, 'max-width': '90%'});
			jQuery('.ui-widget-overlay').css({'z-index': 999998, 'opacity': 0.8, 'background': '#000000'});
			jQuery('.ui-dialog-buttonpane button:contains("Update")').button('disable');
			jQuery.post(
				jQuery('#wp_insert_admin_ajax').val(), {
					'action': 'wp_insert_inthemeads_existing_form_get_content',
					'wp_insert_inthemeads_identifier': identifier,
					'wp_insert_nonce': jQuery('#wp_insert_nonce').val()
				}, function(response) {
					jQuery('.wp_insert_ajaxloader').hide();
					jQuery('.ui-dialog-content').html(response);
					jQuery('.ui-accordion .ui-accordion-content').css('max-height', (jQuery("body").height() * 0.45));
					jQuery('.ui-dialog-buttonpane button:contains("Update")').button('enable');
					jQuery('.wp_insert_inthemeads_status').parent().css({'display': 'inline-block', 'margin': '5px 0 0'}).prependTo('.ui-dialog-buttonpane');
					jQuery('.ui-dialog').css({'position': 'fixed'});
					jQuery('#wp_insert_inthemeads_'+identifier+'_dialog').delay(500).dialog({position: { my: 'center', at: 'center', of: window }});
				}			
			);
		},
		buttons: {
			'Update': function() {
				jQuery("#wp_insert_inthemeads_"+identifier).html("In-Theme Ad : "+jQuery("#wp_insert_inthemeads_"+identifier+"_title").val());
				jQuery("#wp_insert_inthemeads_"+identifier).attr("onClick", "wp_insert_inthemeads_click_handler(\'"+identifier+"\', \'"+jQuery("#wp_insert_inthemeads_"+identifier+"_title").val()+"\')");
				wp_insert_inthemeads_update(identifier);
				jQuery(this).dialog('close');
			},
			Cancel: function() {
				jQuery(this).dialog('close');
			}
		},
		close: function() {
			jQuery(this).dialog('destroy');
		}
	});
}

function wp_insert_inthemeads_update(identifier) {
	args = {};
	args['action'] = 'wp_insert_inthemeads_existing_form_save_action';
	args['wp_insert_nonce'] = jQuery('#wp_insert_nonce').val();
	args['wp_insert_inthemeads_identifier'] = identifier;
	args['wp_insert_inthemeads_'+identifier+'_status'] = jQuery('#wp_insert_inthemeads_'+identifier+'_status').prop('checked');
	
	args['wp_insert_inthemeads_'+identifier+'_title'] = jQuery('#wp_insert_inthemeads_'+identifier+'_title').val();
	
	args['wp_insert_inthemeads_'+identifier+'_primary_ad_code'] = jQuery('#wp_insert_inthemeads_'+identifier+'_primary_ad_code').val();
	args['wp_insert_inthemeads_'+identifier+'_secondary_ad_code'] = jQuery('#wp_insert_inthemeads_'+identifier+'_secondary_ad_code').val();
	args['wp_insert_inthemeads_'+identifier+'_tertiary_ad_code'] = jQuery('#wp_insert_inthemeads_'+identifier+'_tertiary_ad_code').val();
	
	args['wp_insert_inthemeads_'+identifier+'_rules_exclude_loggedin'] = jQuery('#wp_insert_inthemeads_'+identifier+'_rules_exclude_loggedin').prop('checked');
	args['wp_insert_inthemeads_'+identifier+'_rules_exclude_mobile_devices'] = jQuery('#wp_insert_inthemeads_'+identifier+'_rules_exclude_mobile_devices').prop('checked');
	args['wp_insert_inthemeads_'+identifier+'_rules_exclude_home'] = jQuery('#wp_insert_inthemeads_'+identifier+'_rules_exclude_home').prop('checked');
	args['wp_insert_inthemeads_'+identifier+'_rules_exclude_archives'] = jQuery('#wp_insert_inthemeads_'+identifier+'_rules_exclude_archives').prop('checked');
	args['wp_insert_inthemeads_'+identifier+'_rules_exclude_search'] = jQuery('#wp_insert_inthemeads_'+identifier+'_rules_exclude_search').prop('checked');
	args['wp_insert_inthemeads_'+identifier+'_rules_exclude_page'] = jQuery('#wp_insert_inthemeads_'+identifier+'_rules_exclude_page').prop('checked');
	args['wp_insert_inthemeads_'+identifier+'_rules_page_exceptions'] = jQuery.map(jQuery('#wp_insert_inthemeads_'+identifier+'_rules_page_exceptions :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_inthemeads_'+identifier+'_rules_exclude_post'] = jQuery('#wp_insert_inthemeads_'+identifier+'_rules_exclude_post').prop('checked');
	args['wp_insert_inthemeads_'+identifier+'_rules_post_exceptions'] = jQuery.map(jQuery('#wp_insert_inthemeads_'+identifier+'_rules_post_exceptions :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_inthemeads_'+identifier+'_rules_post_categories_exceptions'] = jQuery.map(jQuery('#wp_insert_inthemeads_'+identifier+'_rules_post_categories_exceptions :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_inthemeads_'+identifier+'_rules_exclude_categories'] = jQuery('#wp_insert_inthemeads_'+identifier+'_rules_exclude_categories').prop('checked');
	args['wp_insert_inthemeads_'+identifier+'_rules_categories_exceptions'] = jQuery.map(jQuery('#wp_insert_inthemeads_'+identifier+'_rules_categories_exceptions :selected'), function(e) { return jQuery(e).val(); });
	
	args['wp_insert_inthemeads_'+identifier+'_geo_group1_countries'] = jQuery.map(jQuery('#wp_insert_inthemeads_'+identifier+'_geo_group1_countries :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_inthemeads_'+identifier+'_geo_group1_adcode'] = jQuery('#wp_insert_inthemeads_'+identifier+'_geo_group1_adcode').val();
	args['wp_insert_inthemeads_'+identifier+'_geo_group2_countries'] = jQuery.map(jQuery('#wp_insert_inthemeads_'+identifier+'_geo_group2_countries :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_inthemeads_'+identifier+'_geo_group2_adcode'] = jQuery('#wp_insert_inthemeads_'+identifier+'_geo_group2_adcode').val();
	
	args['wp_insert_inthemeads_'+identifier+'_styles'] = jQuery('#wp_insert_inthemeads_'+identifier+'_styles').val();
	
	args['wp_insert_inthemeads_'+identifier+'_notes'] = jQuery('#wp_insert_inthemeads_'+identifier+'_notes').val();
	
	jQuery.post(
		jQuery('#wp_insert_admin_ajax').val(), args, function(response) { }
	);
}

function wp_insert_inthemeads_remove(identifier) {
	jQuery("<p>Are you Sure you want to remove this Ad Unit?</p>").dialog({
		'modal': true,
		'resizable': false,
		'title': 'Deletion Confirmation',
		position: { my: 'center', at: 'center', of: window },
		open: function (event, ui) {
			jQuery('.ui-dialog').css({'z-index': 999999, 'max-width': '90%'});
			jQuery('.ui-widget-overlay').css({'z-index': 999998, 'opacity': 0.8, 'background': '#000000'});
		},
		buttons : {
			'Confirm': function() {
				jQuery("#wp_insert_inthemeads_"+identifier).parent().remove();
				jQuery.post(
					jQuery('#wp_insert_admin_ajax').val(), {
						'action': 'wp_insert_inthemeads_remove',
						'wp_insert_inthemeads_identifier': identifier,
						'wp_insert_nonce': jQuery('#wp_insert_nonce').val()
					}, function(response) {
					}			
				);
				jQuery(this).dialog("close");
			},
			'Cancel': function() {
				jQuery(this).dialog("close");
			}
		},
		close: function() {
			jQuery(this).dialog('destroy');
		}
	});
}

function wp_insert_legalpages_generate_page(target, title) {
	jQuery('.ui-dialog-buttonpane button:contains("Update")').button('disable');
	jQuery('#'+target+'_generate_page').hide();
	jQuery('#'+target+'_accordion .wp_insert_ajaxloader_flat').show();
	jQuery.post(
		jQuery('#wp_insert_admin_ajax').val(), {
			'action': target+'_form_generate_page_action',
			'wp_insert_nonce': jQuery('#wp_insert_nonce').val(),
		}, function(response) {
			if(response != '0') {
				jQuery('#'+target+'_assigned_page').append(jQuery('<option>', {value: response, text: title})).val(response);
			}
			jQuery('#'+target+'_generate_page').show();
			jQuery('#'+target+'_accordion .wp_insert_ajaxloader_flat').hide();
			jQuery('.ui-dialog-buttonpane button:contains("Update")').button('enable');
		}
	);	
}

function wp_insert_click_handler(target, title, width, height, openAction, UpdateAction, closeAction) {
	jQuery('#'+target).click(function() {
		jQuery('<div id="'+target+'_dialog"></div>').html('<div class="wp_insert_ajaxloader"></div>').dialog({
			'modal': true,
			'resizable': false,
			'width': width,
			'maxWidth': width,
			'maxHeight': height,
			'title': title,
			position: { my: 'center', at: 'center', of: window },
			open: function (event, ui) {
				jQuery('.ui-dialog').css({'z-index': 999999, 'max-width': '90%'});
				jQuery('.ui-widget-overlay').css({'z-index': 999998, 'opacity': 0.8, 'background': '#000000'});
				jQuery('.ui-dialog-buttonpane button:contains("Update")').button('disable');
				
				jQuery.post(
					jQuery('#wp_insert_admin_ajax').val(), {
						'action': target+'_form_get_content',
						'wp_insert_nonce': jQuery('#wp_insert_nonce').val()
					}, function(response) {
						jQuery('.wp_insert_ajaxloader').hide();
						jQuery('.ui-dialog-content').html(response);
						jQuery('.ui-accordion .ui-accordion-content').css('max-height', (jQuery("body").height() * 0.45));
						jQuery('.ui-dialog-buttonpane button:contains("Update")').button('enable');
						openAction();
						jQuery('.ui-dialog').css({'position': 'fixed'});
						jQuery('#'+target+'_dialog').delay(500).dialog({position: { my: 'center', at: 'center', of: window }});
						
					}			
				);
			},
			buttons: {
				'Update': function() {
					UpdateAction();
					jQuery(this).dialog('close');
				},
				Cancel: function() {
					jQuery(this).dialog('close');
				}
			},
			close: function() {
				closeAction();
				jQuery(this).dialog('destroy');
			}
		})
	});
}
	