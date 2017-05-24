<?php
/*
Plugin Name: iLightBox
Plugin URI: http://ilightbox.net/
Description: iLightBox allows you to easily create the most beautiful overlay windows using the jQuery Javascript library. By combining support for a wide range of media with gorgeous skins and a user-friendly API, iLightBox aims to push the Lightbox concept as far as possible.
Version: 1.6.1
Author: Hemn Chawroka
Author URI: http://iprodev.com/
*/
ob_start();


if (!class_exists("iLightBox")) {
	class iLightBox

	{
		/**
		 * iLightBox version
		 *
		 * @var string
		 */
		var $VERSION = '1.6.1';
		/**
		 * iLightBox name
		 *
		 * @var string
		 */
		var $ILIGHTBOX_NAME = 'iLightBox';
		/**
		 * iLightBox jQuery version
		 *
		 * @var string
		 */
		var $JQUERY_VERSION = '2.2.1';
		/**
		 * iLightBox Main file
		 *
		 * @var string
		 */
		var $MAIN;
		/**
		 * iLightBox Main Options
		 *
		 * @var string
		 */
		var $OPTIONS;
		/**
		 * iLightBox URL
		 *
		 * @var string
		 */
		var $ILIGHTBOX_URL;
		/**
		 * iLightBox path
		 *
		 * @var string
		 */
		var $ILIGHTBOX_PATH;
		/**
		 * iLightBox path
		 *
		 * @var string
		 */
		var $ISDEMO = 0;

		function __construct($file)
		{
			$this->MAIN = $file;
			$this->ILIGHTBOX_URL = plugin_dir_url($this->MAIN);
			$this->ILIGHTBOX_PATH = plugin_dir_path($this->MAIN);
			$this->init();
			return $this;
		}

		function init()
		{
			register_activation_hook($this->MAIN, array(
				$this,
				'activate'
			));
			register_deactivation_hook($this->MAIN, array(
				$this,
				'uninstall'
			));
			add_action('init', array(
				$this,
				'register_scripts'
			));
			if (is_admin()) {
				add_action('admin_print_styles', array(
					$this,
					'admin_styles'
				));
				add_action('admin_enqueue_scripts', array(
					$this,
					'admin_enqueue_scripts'
				));
				add_action('admin_head', array(
					$this,
					'admin_head'
				));
				add_filter('tiny_mce_version', array(
					$this,
					'refresh_mce'
				));
				add_action('admin_menu', array(
					$this,
					'add_menu'
				));

				// add_action('network_admin_menu', array($this, 'add_menu'));

				add_action('wp_before_admin_bar_render', array(
					$this,
					'admin_bar_render'
				));
				add_action('admin_head', array(
					$this,
					'menu_style'
				));
				add_action('wp_ajax_ilightbox_actions', array(
					$this,
					'ajax_handler'
				));
				add_action('init', array(
					$this,
					'sc_button'
				));
			}
			else {
				add_shortcode("ilightbox", array(
					$this,
					'shortcode'
				));
				if ($this->get_option('ilightbox_gallery_shortcode') == "true") {
					add_filter('gallery_style', array(
						$this,
						'gallery_style_filter'
					) , 10);
				}

				add_action('wp_head', array(
					$this,
					'enqueue_head'
				));
			}
		}

		/**
		 * Check the WordPress version
		 */
		function is_version($version = '3.5')
		{
			global $wp_version;
			return version_compare($wp_version, $version, '>=');
		}

		/**
		 * Check the Multisite
		 */
		function is_multisite() {
			global $wpmu_version;
			if (function_exists('is_multisite'))
			if (is_multisite()) return true;
			if (!empty($wpmu_version)) return true;
			return false;
		}

		/**
		 * Activate iLightBox
		 */
		function activate() {
			global $wpdb;
			$table_name = $wpdb->prefix . "ilightbox";
			$charset_collate = '';
			if (version_compare($wpdb->db_version() , '4.1.0', '>=')) {
				if (!empty($wpdb->charset)) $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
				if (!empty($wpdb->collate)) $charset_collate.= " COLLATE $wpdb->collate";
			}

			if (!$wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'")) {
				$sql = "CREATE TABLE " . $table_name . " (
				name VARCHAR(255) NOT NULL ,
				value LONGTEXT
				) $charset_collate;";
				require_once (ABSPATH . 'wp-admin/includes/upgrade.php');

				dbDelta($sql);
			}

			$this->OPTIONS = array(
				array(
					"id" => "ilightbox_added_galleries",
					"std" => array()
				) ,
				array(
					"id" => "ilightbox_jetpack",
					"std" => 'true'
				) ,
				array(
					"id" => "ilightbox_nextgen",
					"std" => 'true'
				) ,
				array(
					"id" => "ilightbox_bindeds",
					"std" => array()
				) ,
				array(
					"id" => "ilightbox_auto_enable",
					"std" => 'true'
				) ,
				array(
					"id" => "ilightbox_auto_enable_videos",
					"std" => 'true'
				) ,
				array(
					"id" => "ilightbox_auto_enable_video_sites",
					"std" => 'true'
				) ,
				array(
					"id" => "ilightbox_gallery_shortcode",
					"std" => 'true'
				) ,
				array(
					"id" => "ilightbox_global_options",
					"std" => array(
						'keepAspectRatio' => "on",
						'mobileOptimizer' => "on",
						'overlayBlur' => "on",
						'toolbar' => "on",
						'fullscreen' => "on",
						'thumbnail' => "on",
						'keyboard' => "on",
						'mousewheel' => "on",
						'swipe' => "on",
						'left' => "on",
						'right' => "on",
						'up' => "on",
						'down' => "on",
						'esc' => "on",
						'shift_enter' => "on",
						'show_effect' => "on",
						'hide_effect' => "on",
						'reposition' => "on",
						'startPaused' => "on"
					)
				) ,
				array(
					"id" => "ilightbox_styles",
					"std" => '/*iLightBox additional styles*/'
				) ,
				array(
					"id" => "ilightbox_delete_table",
					"std" => 'false'
				)
			);
			$this->add_general();
			if (get_option("thumbnail_size_w") < 200) update_option("thumbnail_size_w", 200);
			if (get_option("thumbnail_size_h") < 200) update_option("thumbnail_size_h", 200);
			return true;
		}

		/**
		 * Uninstall iLightBox
		 */
		function uninstall() {
			global $wpdb;
			$table_name = $wpdb->prefix . "ilightbox";
			if ($this->get_option('ilightbox_delete_table') == 'true') {
				$wpdb->query("DROP TABLE IF EXISTS " . $table_name);
			}
		}

		function add_option($name, $value) {
			global $wpdb;
			$wpdb->ilightbox = $wpdb->prefix . 'ilightbox';
			$value = maybe_serialize($value);
			$wpdb->insert($wpdb->ilightbox, array(
				'name' => $name,
				'value' => $value
			));
		}

		function get_option($name) {
			global $wpdb;

			if ($cache = $this->get_cache($name)) {
				return $cache;
			}
			else {
				$wpdb->ilightbox = $wpdb->prefix . 'ilightbox';
				$row = $wpdb->get_row("SELECT * FROM $wpdb->ilightbox WHERE name = '$name'", ARRAY_A);
				require (ABSPATH . WPINC . '/pluggable.php');

				if ($row['name'] == '') {
					return false;
				}
				else {
					$results = $wpdb->get_results("SELECT value FROM $wpdb->ilightbox WHERE name = '$name'");
					foreach($results as $result) {
						$data = maybe_unserialize($result->value);
					}

					$this->set_cache($name, $data);

					return $data;
				}
			}
		}

		function update_option($name, $value) {
			global $wpdb;
			$wpdb->ilightbox = $wpdb->prefix . 'ilightbox';

			$this->set_cache($name, $value);

			$serialized = maybe_serialize($value);
			$wpdb->update($wpdb->ilightbox, array(
				'value' => $serialized
			) , array(
				'name' => $name
			));
		}

		function delete_option($name) {
			global $wpdb;
			$wpdb->ilightbox = $wpdb->prefix . 'ilightbox';
			$wpdb->query("DELETE FROM $wpdb->ilightbox WHERE name = '$name'");

			$this->delete_cache($name);
		}

		function get_cache($key) {
			return get_transient('ilightbox_' . $key);
		}

		function set_cache($key, $value) {
			return set_transient('ilightbox_' . $key, $value, DAY_IN_SECONDS);
		}

		function delete_cache($key) {
			return delete_transient('ilightbox_' . $key);
		}

		/*=========================================================================================*/
		function admin_styles() {
			$plugin_version = $this->get_version();
			if (isset($_GET['page']) && strpos($_GET['page'], 'ilightbox') !== false) {
				$deregister_styles = "fineuploader,codemirror,jquery-ui";
				$explode = explode(",", $deregister_styles);
				$wp_version = get_bloginfo('version');
				foreach($explode as $key => $value) {
					wp_deregister_style($value);
					if ($wp_version >= 3.1) wp_dequeue_style($value);
				}

				if (strtolower($_SERVER['SERVER_NAME']) !== 'localhost' && $wp_version < 3.8) wp_enqueue_style("open-sans", "https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700");
				if (strtolower($_SERVER['SERVER_NAME']) !== 'localhost') wp_enqueue_style("droid-serif", "https://fonts.googleapis.com/css?family=Droid+Serif:400italic");
				wp_enqueue_style("ilightbox-css", $this->ILIGHTBOX_URL . "css/ilightbox.css", false, $plugin_version, "all");
				wp_enqueue_style("fineuploader", $this->ILIGHTBOX_URL . "css/fineuploader.css", false, '3.2', "all");
				wp_enqueue_style("ilightbox", $this->ILIGHTBOX_URL . "css/src/css/ilightbox.css", false, $this->JQUERY_VERSION, "all");
				wp_enqueue_style("codemirror", $this->ILIGHTBOX_URL . "css/codemirror.css", false, $plugin_version, "all");
				wp_enqueue_style("jquery-ui", $this->ILIGHTBOX_URL . "css/jquery-ui.css", false, '1.9.2', "all");
			}
		}

		/*=========================================================================================*/
		function admin_enqueue_scripts() {
			if (isset($_GET['page']) && strpos($_GET['page'], 'ilightbox') !== false) {
				$deregister_styles = "jquery.livequery,jquery.migrate,modernizer,codemirror,codemirror-matchbrackets,codemirror-closetag,codemirror-xml,codemirror-javascript,codemirror-css,codemirror-clike,codemirror-php,codemirror-htmlmixed,jquery-ui,jquery.placeholder,fineuploader";
				$explode = explode(",", $deregister_styles);
				$wp_version = get_bloginfo('version');
				foreach($explode as $key => $value) {
					wp_deregister_script($value);
					if ($wp_version >= 3.1) wp_dequeue_script($value);
				}

				// This function loads in the required media files for the media manager.

				if ($this->is_version()) {
					wp_enqueue_media();
				}

				wp_enqueue_script('jquery');
				wp_enqueue_script('jquery.migrate', plugins_url('/scripts/jquery.migrate.min.js', $this->MAIN) , array(
					'jquery'
				) , '1.2.1');
				wp_enqueue_script('jquery.livequery', plugins_url('/scripts/jquery.livequery.js', $this->MAIN) , array(
					'jquery'
				) , '1.0.3');
				wp_enqueue_script('modernizer', plugins_url('/scripts/modernizr.js', $this->MAIN) , array(
					'jquery'
				));
				wp_enqueue_script('codemirror', plugins_url('/scripts/codemirror.js', $this->MAIN));
				wp_enqueue_script('ilightbox');
				wp_enqueue_script('jquery-ui', plugins_url('/scripts/jquery-ui.min.js', $this->MAIN) , array(
					'jquery'
				) , '1.9.2');
				wp_enqueue_script('jquery.placeholder', plugins_url('scripts/jquery.placeholder.min.js', $this->MAIN) , array(
					'jquery'
				) , '2.1.0');
				wp_enqueue_script('fineuploader', plugins_url('/scripts/fineuploader.min.js', $this->MAIN) , array(
					'jquery'
				) , '3.2');
				wp_enqueue_script('ilightbox-admin', plugins_url('/scripts/admin.js', $this->MAIN) , array(
					'jquery'
				) , $this->VERSION);
				global $blog_id;
				$max_upload = (int)(ini_get('upload_max_filesize'));
				$max_post = (int)(ini_get('post_max_size'));
				$memory_limit = (int)(ini_get('memory_limit'));
				$upload_mb = min($max_upload, $max_post, $memory_limit);
				wp_localize_script('ilightbox-admin', 'ILIGHTBOX', array(
					'uploadLimit' => ($upload_mb * 1024 * 1024) ,
					'regularGallery' => $this->get_option('ilightbox_gallery_shortcode') ,
					'pluginURL' => $this->ILIGHTBOX_URL,
					'blogURL' => get_bloginfo('url') ,
					'ajaxURL' => admin_url('admin-ajax.php') ,
					'wpMedia' => $this->is_version()
				));
			}
			else {
				wp_enqueue_script('jquery.migrate');
			}
		}

		/*=========================================================================================*/
		function admin_head() {
			echo '<script type="text/javascript">var ILIGHTBOX_DIR = "' . $this->ILIGHTBOX_URL . '";</script>';
			if (isset($_GET['page']) && strpos($_GET['page'], 'ilightbox') !== false) {
				echo '<link id="site_url" data-url="' . site_url() . '" />';
				echo '<link id="admin_url" data-url="' . get_admin_url() . '" />';
			}
		}

		/*=========================================================================================*/
		function get_attachment_id_from_src($image_src) {
			global $wpdb;
			$query = "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_value='$image_src'";
			$id = $wpdb->get_var($query);
			return $id;
		}

		/*=========================================================================================*/
		function _get_ilightbox($atts, $content = null) {
			extract(shortcode_atts(array(
				'id' => 0,
				'ids' => '',
				'class' => '',
				'columns' => 3
			) , $atts));
			$galleries = $this->get_option('ilightbox_added_galleries');
			$out = "";
			if ($content) {
				$gallery = $galleries[$id];
				$slides = $gallery['slides'];
				if (!is_feed() && $slides) {
					$slides_out = $this->generate_slides($gallery);
					$options_out = $this->generate_options($gallery);
					$options_out = ($options_out) ? ' data-options="' . rawurlencode(stripslashes($options_out)) . '"' : '';
					$out.= '<a class="ilightbox_inline_gallery' . (($class) ? ' ' . $class : '') . '" id="ilightbox_inline_' . $id . '" data-slides="' . rawurlencode($slides_out) . '"' . $options_out . '>';
					$out.= $content;
					$out.= '</a><!-- .ilightbox_inline_gallery -->';
				}
				else $out = $content;
			}
			else {
				if ($ids) {
					if (!is_feed()) {
						$ids = $this->plugin_array_filter(array_map('trim', explode(",", $ids)));
						if (!empty($ids)) {
							$out.= '<div class="ilightbox_clear"></div><!-- .ilightbox_clear -->
							<div id="ilightbox_' . $id . '" class="ilightbox_wrap ilightbox_gallery' . (($class) ? ' ' . $class : '') . '"><ul>';
							$columns = intval($columns);
							$itemwidth = ($columns > 0 ? floor(100 / $columns) : 100) - 3.3;
							$float = is_rtl() ? 'right' : 'left';
							foreach($ids as $key => $id) {
								$gallery = @$galleries[$id];
								if (empty($gallery)) continue;
								$slide = $gallery['slides']['0'];
								$slides_out = $this->generate_slides($gallery);
								$options_out = $this->generate_options($gallery);
								$options_out = ($options_out) ? ' data-options="' . rawurlencode(stripslashes($options_out)) . '"' : '';
								$out.= '<li style="width: ' . $itemwidth . '%; float: ' . $float . '"><a class="ilightbox_inline_gallery" id="ilightbox_inline_' . $id . '" data-slides="' . rawurlencode($slides_out) . '"' . $options_out . '>';
								$out.= '<img src="' . $slide['thumbnail'] . '" />';
								$out.= '</a></li>';
							}

							$out.= '</ul><div class="ilightbox_clear"></div><!-- .ilightbox_clear -->
							</div><!-- .ilightbox_wrap -->';
						}
						else return '';
					}
					else return '';
				}
				else {
					$gallery = $galleries[$id];
					$options = $this->generate_options($gallery, "global", true);
					$opts = $options ? ' data-options="' . rawurlencode(stripslashes($options)) . '"' : "";
					$slides = $gallery['slides'];
					if (is_feed()) {
						foreach($slides as $key => $slide) {
							$att_id = $this->get_attachment_id_from_src(str_replace(site_url("/wp-content/uploads/") , "", $slide['source']));
							$out.= wp_get_attachment_link($att_id, 'thumbnail', true) . "\n";
						}

						return $out;
					}

					$columns = intval($columns);
					$itemwidth = ($columns > 0 ? floor(100 / $columns) : 100) - 3.3;
					$float = is_rtl() ? 'right' : 'left';
					if ($slides) {
						$out.= '<div class="ilightbox_clear"></div><!-- .ilightbox_clear -->
						<div id="ilightbox_' . $id . '" class="ilightbox_wrap ilightbox_gallery' . (($class) ? ' ' . $class : '') . '"' . $opts . '><ul>';
						foreach($slides as $key => $slide) {
							$source = @$slide['source'];
							$link = (@$slide['link']) ? $slide['link'] : $source;
							$caption = (@$slide['caption']) ? " data-caption='" . htmlentities(stripslashes($slide['caption']) , ENT_QUOTES, 'UTF-8') . "'" : "";
							$title = (@$slide['title']) ? " data-title='" . htmlentities(stripslashes($slide['title']) , ENT_QUOTES, 'UTF-8') . "'" : "";
							$type = (@$slide['type']) ? " data-type='" . $slide['type'] . "'" : "";
							$custom_class = trim(@$slide['class']);
							$options = $this->generate_options($slide, "inline", true);
							$opts = ($options) ? ' data-options="' . substr($options, 1, -1) . '"' : "";
							$out.= '<li style="width: ' . $itemwidth . '%; float: ' . $float . '"' . (($custom_class) ? '  class="' . $custom_class . '"' : '') . '><a href="' . $link . '" source="' . $source . '"' . $caption . '' . $title . '' . $type . '' . $opts . '>';
							$out.= '<img src="' . @$slide['thumbnail'] . '" />';
							$out.= '</a></li>';
						}

						$out.= '</ul><div class="ilightbox_clear"></div><!-- .ilightbox_clear -->
						</div><!-- .ilightbox_wrap -->';
					}
				}
			}

			return $out;
		}

		function shortcode($atts, $content = null) {
			return $this->_get_ilightbox($atts, $content);
		}

		function attachment_link_filter($val, $id, $size) {
			$id = intval($id);
			$_post = get_post($id);
			$attach_url = wp_get_attachment_url($_post->ID);
			$thumbnail = wp_get_attachment_image_src($id, 'thumbnail');
			$xml = new DOMDocument();
			$xml->loadXML($val);
			$first = $xml->firstChild;
			$sourceAttribute = $xml->createAttribute('source');
			$sourceAttribute->value = $attach_url;
			$optionsAttribute = $xml->createAttribute('data-options');
			$optionsAttribute->value = "thumbnail: '" . $thumbnail['0'] . "'";
			$first->appendChild($sourceAttribute);
			$first->appendChild($optionsAttribute);
			if ($_post->post_excerpt) {
				$captionAttribute = $xml->createAttribute('data-caption');
				$captionAttribute->value = esc_attr($_post->post_excerpt);
				$first->appendChild($captionAttribute);
			}

			return $xml->saveHTML();
		}

		function gallery_style_filter($val) {
			$options = $this->generate_options($this->get_option('ilightbox_global_options') , "global", true);
			$search = array(
				"gallery-size-thumbnail'>",
				"gallery-size-medium'>",
				"gallery-size-large'>",
				"gallery-size-full'>",
			);
			$replace = array(
				"gallery-size-thumbnail ilightbox_gallery' data-options=\"$options\">",
				"gallery-size-medium ilightbox_gallery' data-options=\"$options\">",
				"gallery-size-large ilightbox_gallery' data-options=\"$options\">",
				"gallery-size-full ilightbox_gallery' data-options=\"$options\">",
			);
			$val = str_replace($search, $replace, $val);
			add_filter('wp_get_attachment_link', array(
				$this,
				'attachment_link_filter'
			) , 10, 3);
			return $val;
		}

		/*=========================================================================================*/
		function sc_button() {
			if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) return;
			if (get_user_option('rich_editing') == 'true') {
				add_filter('mce_external_plugins', array(
					$this,
					'add_ilightbox_sc'
				));
				add_filter('mce_buttons', array(
					$this,
					'register_ilightbox_sc'
				));
			}
		}

		function register_ilightbox_sc($buttons) {
			array_push($buttons, "ilightbox_sc");
			return $buttons;
		}

		function add_ilightbox_sc($plugin_array) {
			$plugin_array['ilightbox_sc'] = $this->ILIGHTBOX_URL . 'scripts/shortcodes.js';
			return $plugin_array;
		}

		function refresh_mce($ver) {
			$ver+= 3;
			return $ver;
		}

		/*=========================================================================================*/
		function register_scripts() {
			wp_register_script('jquery', plugins_url('/scripts/jquery.min.js', $this->MAIN) , false, '1.9.0');
			wp_register_script('jquery.migrate', plugins_url('/scripts/jquery.migrate.min.js', $this->MAIN) , array(
				'jquery'
			) , '1.2.1');
			wp_register_script('jquery.requestAnimationFrame', plugins_url('/scripts/jquery.requestAnimationFrame.js', $this->MAIN) , array(
				'jquery'
			) , '1.0.0');
			wp_register_script('jquery.mousewheel', plugins_url('/scripts/jquery.mousewheel.js', $this->MAIN) , array(
				'jquery'
			) , '3.0.6');
			wp_register_script('ilightbox', plugins_url('/scripts/ilightbox.packed.js', $this->MAIN) , array(
				'jquery',
				'jquery.requestAnimationFrame',
				'jquery.mousewheel'
			) , $this->JQUERY_VERSION);
			wp_register_script('ilightbox.init', plugins_url('/scripts/ilightbox.init.js', $this->MAIN) , array(
				'jquery',
				'ilightbox'
			));
			wp_register_style("ilightbox", plugins_url('/css/src/css/ilightbox.css', $this->MAIN) , false, $this->JQUERY_VERSION, "all");
			wp_register_style('ilightbox-css-front', plugins_url('/css/ilightbox_front.css', $this->MAIN) , false, $this->VERSION, 'all');
		}

		function enqueue_head() {
			$bindeds = $this->get_option('ilightbox_bindeds');
			$bindedGalleries = array();

			if (!empty($bindeds)) {
				$galleries = $this->get_option('ilightbox_added_galleries');
				foreach($bindeds as $key => $value) {
					$gallery = $galleries[$value['id']];
					$slides = $this->generate_slides($gallery);
					if ($slides) {
						$options = $this->generate_options($gallery);
						$query = stripslashes($value['query']);
						$event = @$value['event'];
						$return = @$value['return'];
						$once = @$value['once'];
						$id = @$value['uniqid'];
						$bindedGalleries[] = json_encode(array(
							"event" => $event,
							"query" => $query,
							"return" => $return,
							"slides" => $slides,
							"options" => $options,
							"once" => $once,
							"id" => $id
						));
					}
				}
			}

			wp_localize_script('ilightbox.init', 'ILIGHTBOX', array(
				'options' => $this->generate_options($this->get_option('ilightbox_global_options')) ,
				'jetPack' => $this->get_option('ilightbox_jetpack') == 'true' ? true : false,
				'nextGEN' => $this->get_option('ilightbox_nextgen') == 'true' ? true : false,
				'autoEnable' => $this->get_option('ilightbox_auto_enable') == 'true' ? true : false,
				'autoEnableVideos' => $this->get_option('ilightbox_auto_enable_videos') == 'true' ? true : false,
				'autoEnableVideoSites' => $this->get_option('ilightbox_auto_enable_video_sites') == 'true' ? true : false,
				'bindedGalleries' => $bindedGalleries,
				'instances' => array()
			));
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery.mousewheel');
			wp_enqueue_script('ilightbox');
			wp_enqueue_script('ilightbox.init');
			wp_enqueue_style('ilightbox');
			wp_enqueue_style('ilightbox-css-front');
			$styles = trim(stripslashes(html_entity_decode($this->get_option('ilightbox_styles'))));
			$out = '';
			if ($styles != '' && $styles != '/*iLightBox additional styles*/') {
				$out = '<style>';
				$out.= $styles;
				$out.= '</style>';
			}

			echo $out;
		}

		function generate_slides($gallery) {
			$slides = $gallery['slides'];
			$str = "";
			if ($slides) {
				$str.= "[";
				foreach($slides as $i => $slide) {
					if ($i != 0) $str.= ",";
					$str.= $this->generate_options($slide, "inline");
				}

				$str.= "]";
			}

			return $str;
		}

		function generate_options($arr, $type = "global", $attr = false) {
			if ($type == "global") {
				if (@$arr['useConfiguration']) {
					$arr = $this->get_option('ilightbox_global_options');
				}

				if (@isset($arr['mobileOptimize']) || @isset($arr['tabletOptimize'])) {
					if (!class_exists('Mobile_Detect')) {
						require_once ($this->ILIGHTBOX_PATH . 'lib/classes/Mobile_Detect.php');

					}

					$detect = new Mobile_Detect();
					$isMobile = ($detect->isMobile() && !$detect->isTablet()) ? true : false;
					$isTablet = $detect->isTablet();
					$arrayname = ($isMobile) ? 'mobileOpts' : 'tabletOpts';
				}

				if (@$isMobile || @$isTablet) {
					$newArr = array(
						"maxScale" => $arr[$arrayname]['maxScale'],
						"minScale" => $arr[$arrayname]['minScale'],
						"show_title" => $arr[$arrayname]['show_title'],
						"thumbnail" => $arr[$arrayname]['thumbnail'],
						"thumbnails_maxWidth" => $arr[$arrayname]['thumbnails_maxWidth'],
						"thumbnails_maxHeight" => $arr[$arrayname]['thumbnails_maxHeight'],
						"nextOffsetX" => $arr[$arrayname]['nextOffsetX'],
						"nextOffsetY" => $arr[$arrayname]['nextOffsetY'],
						"prevOffsetX" => $arr[$arrayname]['prevOffsetX'],
						"prevOffsetY" => $arr[$arrayname]['prevOffsetY'],
						"captionStart" => $arr[$arrayname]['captionStart'],
						"captionShow" => $arr[$arrayname]['captionShow'],
						"captionHide" => $arr[$arrayname]['captionHide'],
						"socialStart" => $arr[$arrayname]['socialStart'],
						"socialShow" => $arr[$arrayname]['socialShow'],
						"socialHide" => $arr[$arrayname]['socialHide']
					);
				}

				if (@$arr['mobileOptimize'] && $isMobile) $arr = array_merge($arr, $newArr);
				elseif (@$arr['tabletOptimize'] && $isTablet) $arr = array_merge($arr, $newArr);
				unset($arr['mobileOpts']);
				unset($arr['tabletOpts']);
				$array = @array(
					"attr" => ($attr) ? 'source' : null,
					"path" => $arr['path'],
					"skin" => $arr['skin'],
					"startFrom" => $arr['startFrom'],
					"infinite" => ($arr['infinite']) ? 1 : false,
					"linkId" => trim($arr['linkId']) ,
					"randomStart" => ($arr['randomStart']) ? 1 : false,
					"keepAspectRatio" => ($arr['keepAspectRatio']) ? false : 0,
					"mobileOptimizer" => ($arr['mobileOptimizer']) ? false : 0,
					"maxScale" => $arr['maxScale'],
					"minScale" => $arr['minScale'],
					"innerToolbar" => ($arr['innerToolbar']) ? 1 : false,
					"smartRecognition" => ($arr['smartRecognition']) ? 1 : false,
					"fullAlone" => ($arr['fullAlone']) ? false : 0,
					"fullViewPort" => $arr['fullViewPort'],
					"fullStretchTypes" => $arr['fullStretchTypes'],
					"overlay" => array(
						"opacity" => $arr['overlayOpacity'],
						"blur" => ($arr['overlayBlur']) ? false : 0
					) ,
					"controls" => array(
						"arrows" => ($arr['arrows']) ? 1 : false,
						"slideshow" => ($arr['slideshow']) ? 1 : false,
						"toolbar" => ($arr['toolbar']) ? false : 0,
						"fullscreen" => ($arr['fullscreen']) ? false : 0,
						"thumbnail" => ($arr['thumbnail']) ? false : 0,
						"keyboard" => ($arr['keyboard']) ? false : 0,
						"mousewheel" => ($arr['mousewheel']) ? false : 0,
						"swipe" => ($arr['swipe']) ? false : 0
					) ,
					"keyboard" => array(
						"left" => ($arr['left']) ? false : 0,
						"right" => ($arr['right']) ? false : 0,
						"up" => ($arr['up']) ? false : 0,
						"down" => ($arr['down']) ? false : 0,
						"esc" => ($arr['esc']) ? false : 0,
						"shift_enter" => ($arr['shift_enter']) ? false : 0
					) ,
					"show" => array(
						"effect" => ($arr['show_effect']) ? false : 0,
						"speed" => $arr['show_speed'],
						"title" => ($arr['show_title']) ? false : 0
					) ,
					"hide" => array(
						"effect" => ($arr['hide_effect']) ? false : 0,
						"speed" => $arr['hide_speed']
					) ,
					"caption" => array(
						"start" => ($arr['captionStart']) ? false : 0,
						"show" => ($arr['captionShow'] == 'mouseenter') ? false : $arr['captionShow'],
						"hide" => ($arr['captionHide'] == 'mouseleave') ? false : $arr['captionHide']
					) ,
					"social" => array(
						"start" => ($arr['socialStart']) ? false : 0,
						"show" => ($arr['socialShow'] == 'mouseenter') ? false : $arr['socialShow'],
						"hide" => ($arr['socialHide'] == 'mouseleave') ? false : $arr['socialHide'],
						"buttons" => trim(stripslashes($arr['socialButtons']))
					) ,
					"slideshow" => array(
						"pauseTime" => $arr['pauseTime'],
						"pauseOnHover" => ($arr['slideshow']) ? 1 : false,
						"startPaused" => ($arr['startPaused']) ? false : 0
					) ,
					"styles" => array(
						"pageOffsetX" => $arr['pageOffsetX'],
						"pageOffsetY" => $arr['pageOffsetY'],
						"nextOffsetX" => $arr['nextOffsetX'],
						"nextOffsetY" => $arr['nextOffsetY'],
						"nextOpacity" => $arr['nextOpacity'],
						"nextScale" => $arr['nextScale'],
						"prevOffsetX" => $arr['prevOffsetX'],
						"prevOffsetY" => $arr['prevOffsetY'],
						"prevOpacity" => $arr['prevOpacity'],
						"prevScale" => $arr['prevScale']
					) ,
					"thumbnails" => array(
						"maxWidth" => $arr['thumbnails_maxWidth'],
						"maxHeight" => $arr['thumbnails_maxHeight'],
						"normalOpacity" => $arr['thumbnails_normalOpacity'],
						"activeOpacity" => $arr['thumbnails_activeOpacity']
					) ,
					"effects" => array(
						"reposition" => ($arr['reposition']) ? false : 0,
						"repositionSpeed" => $arr['repositionSpeed'],
						"switchSpeed" => $arr['switchSpeed'],
						"loadedFadeSpeed" => $arr['loadedFadeSpeed'],
						"fadeSpeed" => $arr['fadeSpeed']
					) ,
					"text" => array(
						"close" => (stripslashes($arr['close']) == "Close") ? false : $arr['close'],
						"enterFullscreen" => (stripslashes($arr['enterFullscreen']) == "Enter Fullscreen (Shift+Enter)" || stripslashes($arr['enterFullscreen']) == "Enter Fullscreen (Shift Enter)") ? false : $arr['enterFullscreen'],
						"exitFullscreen" => (stripslashes($arr['exitFullscreen']) == "Exit Fullscreen (Shift+Enter)" || stripslashes($arr['exitFullscreen']) == "Exit Fullscreen (Shift Enter)") ? false : $arr['exitFullscreen'],
						"slideShow" => (stripslashes($arr['slideShowLabel']) == "Slideshow") ? false : $arr['slideShowLabel'],
						"next" => (stripslashes($arr['nextLabel']) == "Next") ? false : $arr['nextLabel'],
						"previous" => (stripslashes($arr['previousLabel']) == "Previous") ? false : $arr['previousLabel']
					) ,
					"errors" => array(
						"loadImage" => (stripslashes($arr['loadImage']) == "An error occurred when trying to load photo.") ? false : $arr['loadImage'],
						"loadContents" => (stripslashes($arr['loadContents']) == "An error occurred when trying to load contents.") ? false : $arr['loadContents'],
						"missingPlugin" => (stripslashes($arr['missingPlugin']) == "The content your are attempting to view requires the <a href='{pluginspage}' target='_blank'>{type} plugin</a>.") ? false : $arr['missingPlugin']
					) ,
					"callback" => array(
						"onAfterChange" => trim(stripslashes($arr['onAfterChange'])) ,
						"onAfterLoad" => trim(stripslashes($arr['onAfterLoad'])) ,
						"onBeforeChange" => trim(stripslashes($arr['onBeforeChange'])) ,
						"onBeforeLoad" => trim(stripslashes($arr['onBeforeLoad'])) ,
						"onEnterFullScreen" => trim(stripslashes($arr['onEnterFullScreen'])) ,
						"onExitFullScreen" => trim(stripslashes($arr['onExitFullScreen'])) ,
						"onHide" => trim(stripslashes($arr['onHide'])) ,
						"onOpen" => trim(stripslashes($arr['onOpen'])) ,
						"onRender" => trim(stripslashes($arr['onRender'])) ,
						"onShow" => trim(stripslashes($arr['onShow']))
					)
				);
			}
			else $array = @array(
				"url" => ($arr['type'] == "html" && $arr['html']) ? "jQuery('" . str_replace(array(
					"\n\r",
					"\n",
					"\r"
				) , "\\n", addslashes(do_shortcode(stripslashes(trim($arr['html']))))) . "')" : $arr['source'],
				"type" => $arr['type'],
				"caption" => $arr['caption'],
				"title" => $arr['title'],
				"options" => array(
					"skin" => $arr['skin'],
					"thumbnail" => $arr['thumbnail'],
					"icon" => $arr['icon'],
					"width" => $arr['width'],
					"height" => $arr['height'],
					"fullViewPort" => $arr['fullViewPort'],
					"mousewheel" => ($arr['mousewheel']) ? false : 0,
					"swipe" => ($arr['swipe']) ? false : 0,
					"smartRecognition" => ($arr['smartRecognition']) ? 1 : false,
					"html5video" => trim(stripslashes($arr['html5video'])) ,
					"ajax" => trim(stripslashes($arr['ajax'])) ,
					"flashvars" => trim(stripslashes($arr['flashvars'])) ,
					"onAfterLoad" => trim(stripslashes($arr['onAfterLoad'])) ,
					"onBeforeLoad" => trim(stripslashes($arr['onBeforeLoad'])) ,
					"onRender" => trim(stripslashes($arr['onRender'])) ,
					"onShow" => trim(stripslashes($arr['onShow']))
				)
			);
			if ($type == "inline" && $attr) $array = $array['options'];
			$str = $this->generate_object($array);
			return trim(trim($str, "}") , "{") ? $str : false;
		}

		function generate_object($arr) {
			$arr = $this->plugin_array_filter($arr);
			$str = "{";
			$i = 0;
			foreach($arr as $key => $val) {
				if ($i != 0) $str.= ",";
				if (is_array($val)) $str.= $key . ":" . $this->generate_object($val);
				else $str.= (is_numeric($val) || preg_match("/^\{/u", trim($val)) || preg_match("/^jQuery/u", trim($val)) || preg_match("/^on/u", $key)) ? $key . ":" . $val : $key . ":'" . $val . "'";
				$i++;
			}

			$str.= "}";
			return $str;
		}

		/*=========================================================================================*/
		function get_version()
		{
			$plugin_data = get_plugin_data($this->MAIN);
			$plugin_version = $plugin_data['Version'];
			return $plugin_version;
		}

		function add_admin_footer()
		{
			$plugin_data = get_plugin_data($this->MAIN);
			printf('<p align="center">%s by %s.</p><div class="clear"></div>', $plugin_data['Title'] . ' ' . $plugin_data['Version'], $plugin_data['Author']);
		}

		/*=========================================================================================*/
		function plugin_array_filter($arr)
		{
			$array = array();
			foreach($arr as $key => $value) {
				if (is_array($value)) {
					$val = $this->plugin_array_filter($value);
					if ($val) $array[$key] = $val;
				}
				else {
					if (trim($arr[$key]) || is_numeric($arr[$key])) $array[$key] = $value;
				}
			}

			return $array;
		}

		function add_general() {
			global $wpdb;
			$this->ilightbox_init();
			foreach($this->OPTIONS as $value) {
				$return = $this->get_option($value['id']);
				if (empty($return) && !is_array($return)) {
					$this->add_option($value['id'], $value['std']);
				}
			}
		}

		function ilightbox_init() {
			$page = $_GET['page'];
			add_action('in_admin_footer', array(
				$this,
				'add_admin_footer'
			));
			if (strstr($page, 'ilightbox_')) {
				include_once ($this->ILIGHTBOX_PATH . "lib/admin/$page.php");
			}
		}

		function add_menu() {
			if (function_exists('add_options_page')) {
				add_menu_page($this->ILIGHTBOX_NAME, $this->ILIGHTBOX_NAME, $this->ISDEMO ? 'edit_posts' : 'manage_options', 'ilightbox_general', array(
					$this,
					'ilightbox_init'
				) , $this->ILIGHTBOX_URL . 'css/images/blank.gif');
				add_submenu_page('ilightbox_general', 'Create New Gallery &lsaquo; ' . $this->ILIGHTBOX_NAME, 'Create New Gallery', $this->ISDEMO ? 'edit_posts' : 'manage_options', 'ilightbox_create', array(
					$this,
					'ilightbox_init'
				));
				add_submenu_page('ilightbox_general', 'Configurations &lsaquo; ' . $this->ILIGHTBOX_NAME, 'Configurations', $this->ISDEMO ? 'edit_posts' : 'manage_options', 'ilightbox_configurations', array(
					$this,
					'ilightbox_init'
				));
				add_submenu_page('ilightbox_general', 'Import/Export &lsaquo; ' . $this->ILIGHTBOX_NAME, 'Import/Export', $this->ISDEMO ? 'edit_posts' : 'manage_options', 'ilightbox_import', array(
					$this,
					'ilightbox_init'
				));
				add_submenu_page('ilightbox_general', 'Documentation &lsaquo; ' . $this->ILIGHTBOX_NAME, 'Documentation', $this->ISDEMO ? 'edit_posts' : 'manage_options', 'ilightbox_documentation', array(
					$this,
					'ilightbox_init'
				));
			}
		}

		function admin_bar_render() {
			global $wp_admin_bar;
			$wp_admin_bar->add_menu(array(
				'parent' => false,
				'id' => 'ilightbox_general',
				'title' => '<span class="ab-icon"></span><span class="ab-label">iLightBox</span>',
				'href' => admin_url('admin.php?page=ilightbox_general')
			));
			$wp_admin_bar->add_menu(array(
				'parent' => 'ilightbox_general',
				'id' => 'ilightbox_create',
				'title' => 'Create New Gallery',
				'href' => admin_url('admin.php?page=ilightbox_create')
			));
			$wp_admin_bar->add_menu(array(
				'parent' => 'ilightbox_general',
				'id' => 'ilightbox_configurations',
				'title' => 'Configurations',
				'href' => admin_url('admin.php?page=ilightbox_configurations')
			));
			$wp_admin_bar->add_menu(array(
				'parent' => 'ilightbox_general',
				'id' => 'ilightbox_documentation',
				'title' => 'Documentation',
				'href' => admin_url('admin.php?page=ilightbox_documentation')
			));
		}

		function menu_style() {
	?>
			<style type="text/css" media="screen">
				#toplevel_page_ilightbox_general .wp-menu-image {
					background: url(<?php
			echo $this->ILIGHTBOX_URL; ?>css/images/menu_icon.png) no-repeat 0 0 !important;
					opacity: .7;
					filter: alpha(opacity=70);
				}
				#toplevel_page_ilightbox_general:hover .wp-menu-image, #toplevel_page_ilightbox_general.current .wp-menu-image, #toplevel_page_ilightbox_general.wp-menu-open .wp-menu-image {
					background-position: 0 0!important;
					opacity: 1;
					filter: alpha(opacity=100);
				}
				#wp-admin-bar-ilightbox_general .ab-icon {
					background: url(<?php
			echo $this->ILIGHTBOX_URL; ?>css/images/menu_icon.png) no-repeat 50% 50% !important;
					margin-right: 5px;
				}

			</style>
		<?php
		}

		function replace_in_array($array, $search, $replace) {
			$result = array();

			foreach ($array as $key => $element) {
				if (is_array($element))
					$res = $this->replace_in_array($element, $search, $replace);
				elseif (is_string($element))
					$res = str_ireplace($search, $replace, $element);
				else
					$res = $element;

				$result[$key] = $res;
			}

			return $result;
		}

		function ajax_handler() {
			$result = array();
			$p = @$_POST;
			$form = @$p['form'];
			if ($form) {
				parse_str($form, $p);
			}

			$action = @$p['_action'];

			// check for rights

			if (!current_user_can('edit_pages') && !current_user_can('edit_posts')) $result = array(
				'status' => 403,
				'message' => __("You are not allowed to be here")
			);
			else {
				if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && $action) {
					if ($action == "saveConfigurations") {
						if (current_user_can('manage_options')) {
							$ticks = "ilightbox_auto_enable,ilightbox_auto_enable_videos,ilightbox_auto_enable_video_sites,ilightbox_gallery_shortcode,ilightbox_delete_table,ilightbox_jetpack,ilightbox_nextgen";
							$explode = explode(",", $ticks);
							foreach($p as $key => $value) {
								if (!stristr($ticks, $key)) $this->update_option($key, (is_array($value)) ? $this->plugin_array_filter($value) : $value);
							}

							foreach($explode as $key => $value) {
								$val = ($p[$value]) ? 'true' : 'false';
								$this->update_option($value, $val);
							}

							$result = array(
								'status' => 200,
								'message' => "Configurations saved."
							);
						}
						else $result = array(
							'status' => 403,
							'message' => "You are not allowed to change the configurations."
						);
					}
					elseif ($action == "import") {
						if (current_user_can('manage_options')) {
							$code = 400;
							$message = "Bad Request";

							try {
								$import_code = $p['import_code'];

								if (strlen($import_code) <= 10)
									throw new Exception('Please insert a valid import code.');

								$base64_decoded = base64_decode($import_code);
								$json = json_decode($base64_decoded, true);

								if (!is_array($json))
									throw new Exception('Import code is not valid.');

								$options = $json['options'];
								$import_upload_dir = $json['upload_dir'];
								$current_upload_dir = wp_upload_dir();

								foreach ($options as $key => $value) {
									if ($key === 'ilightbox_added_galleries')
										$value = $this->replace_in_array($value, $import_upload_dir, $current_upload_dir);

									$this->update_option($key, $value);
								}

								$code = 200;
								$message = "Imported successfully.";
							}
							catch(Exception $e) {
								$message = $e->getMessage();
							}

							$result = array(
								'status' => $code,
								'message' => $message
							);
						}
						else $result = array(
							'status' => 403,
							'message' => "You are not allowed to change the configurations."
						);
					}
					elseif ($action == "createGallery") {
						unset($p['action']);
						$gallery = $this->plugin_array_filter($p);

						if (count($gallery['slides']) < 1) $result = array(
							'status' => 403,
							'message' => "Please add at least 1 slides to create the gallery!"
						);
						else {
							$uid = get_current_user_id();
							$galleries = $this->get_option('ilightbox_added_galleries');
							$gallery['uid'] = $uid;
							$gallery['lastEdit'] = time();
							$galleries[] = $gallery;
							$message = "Gallery created.";
							$last = end(array_keys($galleries));
							$this->update_option('ilightbox_added_galleries', $galleries);

							$result = array(
								'status' => 200,
								'gid' => $last,
								'message' => $message
							);
						}
					}
					elseif ($action == "editGallery") {
						unset($p['action']);
						$id = @$p['gid'];
						$uid = get_current_user_id();
						$galleries = $this->get_option('ilightbox_added_galleries');
						$gallery = $this->plugin_array_filter($p);

						if (($this->ISDEMO && $galleries[$id]['uid'] == $uid) || current_user_can('manage_options')) {
							$gallery['uid'] = $uid;
							$gallery['lastEdit'] = time();
							if ($id >= 0) {
								$galleries[$id] = $gallery;
								$message = "Changes saved.";
							}

							$this->update_option('ilightbox_added_galleries', $galleries);
							$result = array(
								'status' => 200,
								'gid' => $id,
								'message' => $message
							);
						}
						else $result = array(
							'status' => 403,
							'message' => "You are not allowed to edit this gallery."
						);
					}
					elseif ($action == "getAttachmentUrl") {
						$id = (@$p['id']) ? $p['id'] : $this->get_attachment_id_from_src($p['path']);
						if ($id == '') {
							$image_src = $p['path'];
							if (strpos(substr($image_src, -10) , 'x') && strpos(substr($image_src, -15) , '-')) {
								$pos = strrpos($image_src, '-');
								$image_src = substr($image_src, 0, $pos) . substr($image_src, -4);
							}

							$id = $this->get_attachment_id_from_src($image_src);
						}

						$url = wp_get_attachment_url($id);
						$thumb = wp_get_attachment_image_src($id, 'thumbnail');
						$result = array(
							'status' => 200,
							'url' => $url,
							'thumb' => $thumb['0']
						);
					}
					elseif ($action == "removeGallery") {
						$id = @$p['id'];
						$uid = get_current_user_id();
						$galleries = $this->get_option('ilightbox_added_galleries');

						if (($this->ISDEMO && $galleries[$id]['uid'] == $uid) || current_user_can('manage_options')) {
							if ($id >= 0) {
								$galleries = $this->get_option('ilightbox_added_galleries');
								$bindeds = $this->get_option('ilightbox_bindeds');
								unset($galleries[$id]);
								foreach($bindeds as $key => $value) {
									if ($value['id'] == $id) unset($bindeds[$key]);
								}

								$this->update_option('ilightbox_added_galleries', $galleries);
								$this->update_option('ilightbox_bindeds', $bindeds);
							}

							$result = array(
								'status' => 200,
								'message' => "Gallery removed."
							);
						}
						else $result = array(
							'status' => 403,
							'message' => "You are not allowed to remove this gallery."
						);
					}
					elseif ($action == "bindGallery" || $action == "rebindGallery") {
						$id = $p['bid'];
						unset($p['action']);
						unset($p['bid']);
						$bind = $this->plugin_array_filter($p);
						$uid = get_current_user_id();
						$bindeds = $this->get_option('ilightbox_bindeds');
						$bind['uid'] = $uid;
						$bind['lastEdit'] = time();
						$bind['uniqid'] = uniqid();
						if ($bind['query']) {
							if ($action == "rebindGallery") $bindeds[$id] = $bind;
							else $bindeds[] = $bind;
							$this->update_option('ilightbox_bindeds', $bindeds);
							$result = array(
								'status' => 200,
								'message' => ($action == "rebindGallery") ? "Gallery rebinded." : "Gallery binded."
							);
						}
						else $result = array(
							'status' => 400,
							'message' => 'Please write the CSS DOM Selector Query!'
						);
					}
					elseif ($action == "unbindGallery") {
						$id = @$p['id'];
						if ($id >= 0) {
							$bindeds = $this->get_option('ilightbox_bindeds');
							unset($bindeds[$id]);
							$this->update_option('ilightbox_bindeds', $bindeds);
						}

						$result = array(
							'status' => 200,
							'message' => 'Gallery unbinded.'
						);
					}
					elseif ($action == "previewGallery") {
						$id = @$p['id'];
						if ($id >= 0) {
							$galleries = $this->get_option('ilightbox_added_galleries');
							$gallery = $galleries[$id];
						}

						if (!isset($gallery)) $gallery = $this->plugin_array_filter($p);
						$slides = $this->generate_slides($gallery);
						$options = $this->generate_options($gallery);
						if ($slides) $result = array(
							'status' => 200,
							'slides' => $slides,
							'options' => $options,
						);
						else $result = array(
							'status' => 400,
							'message' => "Please add slides to preview."
						);
					}
					else $result = array(
						'status' => 400,
						'message' => "Bad Request"
					);
				}
				else {
					$result = array(
						'status' => 403,
						'message' => __("You are not allowed to be here")
					);
				}
			}

			ob_clean();
			echo json_encode($result);
			die();
		}
	}

	$iLightBox = @new iLightBox(__FILE__);

	function get_ilightbox( $atts, $content = null ) {
		global $iLightBox;		
		return $iLightBox->_get_ilightbox( $atts, $content );
	}
}
?>