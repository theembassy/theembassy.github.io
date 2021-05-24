<?php
/**
 * File that holds all the author plugins functions
 *
 * @package WordPress_Plugins
 * @subpackage SimpleYearlyArchive
 */

/**
 * Writes CSS and JS to the plugin page's header for displaying my other plugins
 *
 * @since 1.1.1
 * @author scripts@schloebe.de
 */
function sya_authorplugins_head() {
	$plugin = SimpleYearlyArchive::get_instance();
	wp_enqueue_script( 'os_authorplugins_script', $plugin->get_plugin_url() . "admin/assets/js/os_authorplugins_script.js", array('jquery'), $plugin->get_plugin_version() );
	$sya_authorplugins_style  = "\n<link rel='stylesheet' href='" . $plugin->get_plugin_url() . "admin/assets/css/os_authorplugins_style.css' type='text/css' media='all' />\n";
	print( $sya_authorplugins_style );
}

/**
 * Plugin credits in WP footer
 *
 * @since 1.1.1
 * @author scripts@schloebe.de
 */
function sya_plugin_footer() {
	$plugin = SimpleYearlyArchive::get_instance();
	$plugin_data = get_plugin_data( $plugin->get_plugin_path() . 'simple-yearly-archive.php' );
	$plugin_data['Title'] = $plugin_data['Name'];
	if ( !empty($plugin_data['Plugin URI']) && !empty($plugin_data['Name']) )
		$plugin_data['Title'] = '<a href="' . $plugin_data['Plugin URI'] . '" title="'.__( 'Visit plugin homepage' ).'">' . $plugin_data['Name'] . '</a>';
	
	if ( basename($_SERVER['REQUEST_URI']) == 'options-general.php?page=simple-yearly-archive' ) {
		printf('%1$s ' . __('plugin') . ' | ' . __('Version') . ' <a href="http://www.schloebe.de/wordpress/simple-yearly-archive-plugin/" title="">%2$s</a> | ' . __('Author') . ' %3$s<br />', $plugin_data['Title'], $plugin_data['Version'], $plugin_data['Author']);
	}
}

/**
 * Initialization of author plugins stuff
 *
 * @since 1.1.1
 * @author scripts@schloebe.de
 */
function sya_authorplugins_init() {
	global $wp_version;
	add_action('in_admin_footer', 'sya_plugin_footer');
}

if( basename($_SERVER['REQUEST_URI']) == 'options-general.php?page=simple-yearly-archive' ) {
	add_action( "admin_print_scripts", 'sya_authorplugins_head' );
}
add_action( 'admin_init', 'sya_authorplugins_init', 1 );
?>