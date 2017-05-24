<?php 
/* Begin Version Upgrade */
add_action('init', 'wp_insert_upgrade_version', 0);
function wp_insert_upgrade_version() {
	$databaseVersion = get_option('wp_insert_version');
	if($databaseVersion != WP_INSERT_VERSION) {
		do_action('wp_insert_upgrade_database');
		update_option('wp_insert_version', WP_INSERT_VERSION);
	}
}
/* End Version Upgrade */

/* Begin Misc Functions */
function wp_insert_add_ordinal_number_suffix($num) {
	if (!in_array(($num % 100),array(11,12,13))){
		switch ($num % 10) {
			case 1:  return $num.'st';
			case 2:  return $num.'nd';
			case 3:  return $num.'rd';
		}
	}
	return $num.'th';
}
/* End Misc Functions */
?>